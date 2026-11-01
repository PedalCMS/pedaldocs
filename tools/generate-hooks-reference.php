<?php
/**
 * Generates the Markdown hooks reference for the developer handbook.
 *
 * Scans the plugin source for every `pedalcms/...` action and filter, reads the
 * docblock that sits directly above each call, and writes a Markdown page to
 * standard output. Nothing is written to disk by the script itself.
 *
 * Usage:
 *   php tools/generate-hooks-reference.php <plugin-dir> [version] [git-ref] > hooks-reference.md
 *
 *   plugin-dir  Path of a Pedal CMS checkout (the folder that contains pedalcms.php).
 *   version     Plugin version shown in the intro. Defaults to PEDALCMS_VERSION in pedalcms.php.
 *   git-ref     Branch or tag used in the source links. Defaults to "main".
 *
 * @package PedalCMS
 */

// phpcs:disable WordPress.WP.AlternativeFunctions -- Standalone CLI script; WordPress is not loaded.
// phpcs:disable WordPress.Security.EscapeOutput -- Output is Markdown for a static site, not HTML for a browser.

if ( 'cli' !== PHP_SAPI ) {
	exit( 1 );
}

/**
 * Hook functions to look for, mapped to the kind of hook they create.
 *
 * @return array<string,string> Function name => 'action' or 'filter'.
 */
function pedalcms_hooks_functions(): array {
	return [
		'apply_filters'            => 'filter',
		'apply_filters_ref_array'  => 'filter',
		'apply_filters_deprecated' => 'filter',
		'do_action'                => 'action',
		'do_action_ref_array'      => 'action',
		'do_action_deprecated'     => 'action',
	];
}

/**
 * Lists the PHP files to scan, relative to the plugin root, in a stable order.
 *
 * @param string $root Absolute path of the plugin root.
 * @return string[] Relative file paths.
 */
function pedalcms_hooks_list_files( string $root ): array {
	$files = [ 'pedalcms.php' ];

	foreach ( [ 'src', 'templates', 'admin/templates' ] as $dir ) {
		if ( ! is_dir( $root . '/' . $dir ) ) {
			continue;
		}

		$iterator = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator( $root . '/' . $dir, FilesystemIterator::SKIP_DOTS )
		);

		foreach ( $iterator as $file ) {
			if ( $file->isFile() && 'php' === $file->getExtension() ) {
				$files[] = ltrim( substr( $file->getPathname(), strlen( $root ) ), '/' );
			}
		}
	}

	$files = array_values( array_unique( $files ) );
	sort( $files, SORT_STRING );

	return $files;
}

/**
 * Tells whether a token is whitespace or a plain comment.
 *
 * @param mixed $token A token from token_get_all().
 * @return bool
 */
function pedalcms_hooks_is_blank( $token ): bool {
	return is_array( $token ) && in_array( $token[0], [ T_WHITESPACE, T_COMMENT ], true );
}

/**
 * Finds the previous token that is not whitespace or a comment.
 *
 * @param array $tokens Token list.
 * @param int   $index  Index to start from (exclusive).
 * @return int Index of the previous significant token, or -1.
 */
function pedalcms_hooks_prev_index( array $tokens, int $index ): int {
	for ( $i = $index - 1; $i >= 0; $i-- ) {
		if ( ! pedalcms_hooks_is_blank( $tokens[ $i ] ) ) {
			return $i;
		}
	}

	return -1;
}

/**
 * Finds the next token that is not whitespace or a comment.
 *
 * @param array $tokens Token list.
 * @param int   $index  Index to start from (exclusive).
 * @return int Index of the next significant token, or -1.
 */
function pedalcms_hooks_next_index( array $tokens, int $index ): int {
	$count = count( $tokens );

	for ( $i = $index + 1; $i < $count; $i++ ) {
		if ( ! pedalcms_hooks_is_blank( $tokens[ $i ] ) ) {
			return $i;
		}
	}

	return -1;
}

/**
 * Returns the source text of a token.
 *
 * @param mixed $token A token from token_get_all().
 * @return string
 */
function pedalcms_hooks_text( $token ): string {
	return is_array( $token ) ? $token[1] : $token;
}

/**
 * Collects the argument list of a call.
 *
 * Walks from the opening parenthesis to its matching closing parenthesis and
 * splits the source on top-level commas.
 *
 * @param array $tokens     Token list.
 * @param int   $open_index Index of the opening parenthesis.
 * @return string[] Raw argument source, one entry per argument.
 */
function pedalcms_hooks_collect_args( array $tokens, int $open_index ): array {
	$count   = count( $tokens );
	$depth   = 0;
	$args    = [];
	$current = '';

	for ( $i = $open_index; $i < $count; $i++ ) {
		$token = $tokens[ $i ];
		$text  = pedalcms_hooks_text( $token );
		$type  = is_array( $token ) ? $token[0] : null;

		if ( '(' === $text || '[' === $text || '{' === $text || T_CURLY_OPEN === $type || T_DOLLAR_OPEN_CURLY_BRACES === $type ) {
			++$depth;
			if ( 1 === $depth && '(' === $text ) {
				continue;
			}
		} elseif ( ')' === $text || ']' === $text || '}' === $text ) {
			--$depth;
			if ( 0 === $depth ) {
				break;
			}
		} elseif ( ',' === $text && 1 === $depth ) {
			$args[]  = trim( $current );
			$current = '';
			continue;
		}

		$current .= $text;
	}

	if ( '' !== trim( $current ) ) {
		$args[] = trim( $current );
	}

	return $args;
}

/**
 * Finds the docblock that documents a hook call, if there is one.
 *
 * The docblock must be separated from the call only by whitespace, comments,
 * variables, assignments, `return`, `echo`, casts, opening parentheses and
 * simple array access. A semicolon or a brace in between means the docblock
 * belongs to something else.
 *
 * @param array $tokens     Token list.
 * @param int   $call_index Index of the hook function name.
 * @return string Raw docblock, or an empty string.
 */
function pedalcms_hooks_find_docblock( array $tokens, int $call_index ): string {
	$casts = [ T_INT_CAST, T_DOUBLE_CAST, T_STRING_CAST, T_ARRAY_CAST, T_OBJECT_CAST, T_BOOL_CAST ];
	$ok    = [
		T_WHITESPACE,
		T_COMMENT,
		T_VARIABLE,
		T_RETURN,
		T_ECHO,
		T_OBJECT_OPERATOR,
		T_STRING,
		T_CONSTANT_ENCAPSED_STRING,
		T_LNUMBER,
	];

	for ( $i = $call_index - 1; $i >= 0; $i-- ) {
		$token = $tokens[ $i ];

		if ( is_array( $token ) ) {
			if ( T_DOC_COMMENT === $token[0] ) {
				return $token[1];
			}

			if ( in_array( $token[0], $ok, true ) || in_array( $token[0], $casts, true ) ) {
				continue;
			}

			return '';
		}

		if ( in_array( $token, [ '=', '(', '[', ']' ], true ) ) {
			continue;
		}

		return '';
	}

	return '';
}

/**
 * Parses a raw docblock into summary, @since lines and @param lines.
 *
 * @param string $raw Raw docblock including the comment markers.
 * @return array{summary:string,since:string[],params:array}
 */
function pedalcms_hooks_parse_docblock( string $raw ): array {
	$result = [
		'summary' => '',
		'since'   => [],
		'params'  => [],
	];

	$body  = preg_replace( '#^/\*\*|\*/$#', '', trim( $raw ) );
	$lines = [];

	foreach ( preg_split( '/\R/', $body ) as $line ) {
		$lines[] = rtrim( preg_replace( '/^\s*\*? ?/', '', $line ) );
	}

	$summary = [];
	$tags    = [];
	$tag     = null;

	foreach ( $lines as $line ) {
		if ( preg_match( '/^@(\w+)\s*(.*)$/', $line, $match ) ) {
			$tags[] = [ $match[1], $match[2] ];
			$tag    = count( $tags ) - 1;
		} elseif ( null !== $tag ) {
			if ( '' !== trim( $line ) ) {
				$tags[ $tag ][1] .= ' ' . trim( $line );
			}
		} else {
			$summary[] = $line;
		}
	}

	$text = trim( implode( "\n", $summary ) );
	$text = preg_replace( '/\{@see\s+([^}]+)\}/', '`$1`', $text );
	$text = preg_replace( '/\n{3,}/', "\n\n", $text );

	// Join soft-wrapped lines inside a paragraph, keep paragraph breaks.
	$paragraphs = array_map(
		static function ( string $paragraph ): string {
			return preg_replace( '/\s*\n\s*/', ' ', trim( $paragraph ) );
		},
		explode( "\n\n", $text )
	);

	$result['summary'] = implode( "\n\n", array_filter( $paragraphs ) );

	foreach ( $tags as $entry ) {
		list( $name, $value ) = $entry;
		$value                = preg_replace( '/\{@see\s+([^}]+)\}/', '`$1`', $value );

		if ( 'since' === $name && '' !== $value ) {
			$result['since'][] = $value;
		} elseif ( 'param' === $name && '' !== $value ) {
			if ( preg_match( '/^(?:(\S+)\s+)?(\$\S+)\s*(.*)$/', $value, $match ) ) {
				$result['params'][] = [
					'type' => $match[1],
					'name' => $match[2],
					'desc' => $match[3],
				];
			}
		}
	}

	return $result;
}

/**
 * Normalizes the hook name argument.
 *
 * @param string $expression Raw first argument of the call.
 * @return array{name:string,dynamic:bool,raw:string}|null Null when the hook is not a pedalcms/ hook.
 */
function pedalcms_hooks_parse_name( string $expression ): ?array {
	$expression = trim( $expression );

	// A single constant string.
	if ( preg_match( "/^'([^'\\\\]*)'$/", $expression, $match ) || preg_match( '/^"([^"$\\\\{]*)"$/', $expression, $match ) ) {
		if ( 0 !== strpos( $match[1], 'pedalcms/' ) ) {
			return null;
		}

		return [
			'name'    => $match[1],
			'dynamic' => false,
			'raw'     => $expression,
		];
	}

	// Interpolated string: "pedalcms/options/{$option}".
	if ( preg_match( '/^"(pedalcms\/[^"]*)"$/', $expression, $match ) ) {
		return [
			'name'    => $match[1],
			'dynamic' => true,
			'raw'     => $expression,
		];
	}

	// Concatenation: 'pedalcms/before_template/' . $template.
	if ( preg_match( "/^'(pedalcms\/[^']*)'\s*\.\s*(\\\$\w+)\$/", $expression, $match ) ) {
		return [
			'name'    => $match[1] . '{' . $match[2] . '}',
			'dynamic' => true,
			'raw'     => $expression,
		];
	}

	// Any other expression that starts with a pedalcms/ string.
	if ( preg_match( '/^[\'"]pedalcms\//', $expression ) ) {
		return [
			'name'    => $expression,
			'dynamic' => true,
			'raw'     => $expression,
		];
	}

	return null;
}

/**
 * Scans one file for hook calls.
 *
 * @param string $root Plugin root.
 * @param string $file File path relative to the root.
 * @return array[] Found hook calls.
 */
function pedalcms_hooks_scan_file( string $root, string $file ): array {
	$source = file_get_contents( $root . '/' . $file );
	if ( false === $source ) {
		return [];
	}

	$tokens    = token_get_all( $source );
	$functions = pedalcms_hooks_functions();
	$found     = [];
	$count     = count( $tokens );

	for ( $i = 0; $i < $count; $i++ ) {
		$token = $tokens[ $i ];

		if ( ! is_array( $token ) || ! in_array( $token[0], [ T_STRING, T_NAME_FULLY_QUALIFIED ], true ) ) {
			continue;
		}

		$function = ltrim( $token[1], '\\' );
		if ( ! isset( $functions[ $function ] ) ) {
			continue;
		}

		$prev = pedalcms_hooks_prev_index( $tokens, $i );
		if ( $prev >= 0 && is_array( $tokens[ $prev ] ) && in_array( $tokens[ $prev ][0], [ T_OBJECT_OPERATOR, T_NULLSAFE_OBJECT_OPERATOR, T_DOUBLE_COLON, T_FUNCTION, T_NEW ], true ) ) {
			continue;
		}

		$next = pedalcms_hooks_next_index( $tokens, $i );
		if ( $next < 0 || '(' !== $tokens[ $next ] ) {
			continue;
		}

		$args = pedalcms_hooks_collect_args( $tokens, $next );
		if ( empty( $args ) ) {
			continue;
		}

		$name = pedalcms_hooks_parse_name( array_shift( $args ) );
		if ( null === $name ) {
			continue;
		}

		$found[] = [
			'kind'     => $functions[ $function ],
			'name'     => $name['name'],
			'dynamic'  => $name['dynamic'],
			'raw'      => $name['raw'],
			'args'     => $args,
			'file'     => $file,
			'line'     => $token[2],
			'docblock' => pedalcms_hooks_find_docblock( $tokens, $i ),
		];
	}

	return $found;
}

/**
 * Shortens an argument's source so the page stays readable.
 *
 * @param string $arg Raw argument source.
 * @return string
 */
function pedalcms_hooks_format_arg( string $arg ): string {
	$arg = trim( preg_replace( '/\s+/', ' ', $arg ) );

	if ( strlen( $arg ) > 60 && '[' === substr( $arg, 0, 1 ) ) {
		return '[ … ]';
	}

	if ( strlen( $arg ) > 80 ) {
		return substr( $arg, 0, 77 ) . '…';
	}

	return $arg;
}

/**
 * Renders one hook as Markdown.
 *
 * @param string $name Hook name.
 * @param array  $hook Grouped hook data.
 * @param string $ref  Git ref for source links.
 * @return string
 */
function pedalcms_hooks_render_hook( string $name, array $hook, string $ref ): string {
	$out = '### `' . $name . "`\n\n";

	if ( '' !== $hook['doc']['summary'] ) {
		$out .= $hook['doc']['summary'] . "\n\n";
	}

	if ( $hook['dynamic'] ) {
		$out .= '**Dynamic hook:** the name is built at runtime from `' . $hook['raw'] . "`.\n\n";
	}

	$args = array_map( 'pedalcms_hooks_format_arg', $hook['args'] );
	$out .= '**Arguments:** ' . ( $args ? '`' . implode( '`, `', $args ) . '`' : 'none' ) . "\n\n";

	if ( $hook['doc']['since'] ) {
		$out .= '**Since:** ' . implode( '; ', $hook['doc']['since'] ) . "\n\n";
	}

	if ( $hook['doc']['params'] ) {
		$out .= "**Parameters:**\n\n";
		foreach ( $hook['doc']['params'] as $param ) {
			$out .= '- `' . $param['name'] . '`';
			if ( $param['type'] ) {
				$out .= ' (`' . $param['type'] . '`)';
			}
			if ( $param['desc'] ) {
				$out .= ' - ' . $param['desc'];
			}
			$out .= "\n";
		}
		$out .= "\n";
	}

	$links = [];
	foreach ( $hook['locations'] as $location ) {
		$links[] = sprintf(
			'[%1$s:%2$d](https://github.com/PedalCMS/pedalcms/blob/%3$s/%1$s#L%2$d)',
			$location['file'],
			$location['line'],
			$ref
		);
	}
	$out .= '**Source:** ' . implode( ', ', $links ) . "\n\n";

	return $out;
}

$pedalcms_root = isset( $argv[1] ) ? realpath( $argv[1] ) : false;
if ( false === $pedalcms_root || ! is_file( $pedalcms_root . '/pedalcms.php' ) ) {
	fwrite( STDERR, "Usage: php tools/generate-hooks-reference.php <plugin-dir> [version] [git-ref] > hooks-reference.md\n" );
	exit( 1 );
}

$pedalcms_version = $argv[2] ?? '';
if ( '' === $pedalcms_version ) {
	$pedalcms_main = file_get_contents( $pedalcms_root . '/pedalcms.php' );
	if ( false !== $pedalcms_main && preg_match( "/define\\(\\s*'PEDALCMS_VERSION',\\s*'([^']+)'/", $pedalcms_main, $pedalcms_match ) ) {
		$pedalcms_version = $pedalcms_match[1];
	} else {
		fwrite( STDERR, "Unable to read PEDALCMS_VERSION from pedalcms.php.\n" );
		exit( 1 );
	}
}

$pedalcms_ref = $argv[3] ?? 'main';

$pedalcms_hooks = [
	'action' => [],
	'filter' => [],
];

foreach ( pedalcms_hooks_list_files( $pedalcms_root ) as $pedalcms_file ) {
	foreach ( pedalcms_hooks_scan_file( $pedalcms_root, $pedalcms_file ) as $pedalcms_found ) {
		$pedalcms_kind = $pedalcms_found['kind'];
		$pedalcms_name = $pedalcms_found['name'];

		if ( ! isset( $pedalcms_hooks[ $pedalcms_kind ][ $pedalcms_name ] ) ) {
			$pedalcms_hooks[ $pedalcms_kind ][ $pedalcms_name ] = [
				'dynamic'   => $pedalcms_found['dynamic'],
				'raw'       => $pedalcms_found['raw'],
				'args'      => $pedalcms_found['args'],
				'doc'       => [
					'summary' => '',
					'since'   => [],
					'params'  => [],
				],
				'locations' => [],
			];
		}

		$pedalcms_entry = &$pedalcms_hooks[ $pedalcms_kind ][ $pedalcms_name ];

		// The first docblock found wins; later duplicates only add locations.
		if ( '' !== $pedalcms_found['docblock'] && '' === $pedalcms_entry['doc']['summary'] && ! $pedalcms_entry['doc']['since'] && ! $pedalcms_entry['doc']['params'] ) {
			$pedalcms_entry['doc'] = pedalcms_hooks_parse_docblock( $pedalcms_found['docblock'] );
		}

		$pedalcms_entry['locations'][] = [
			'file' => $pedalcms_found['file'],
			'line' => $pedalcms_found['line'],
		];
		unset( $pedalcms_entry );
	}
}

ksort( $pedalcms_hooks['action'], SORT_STRING );
ksort( $pedalcms_hooks['filter'], SORT_STRING );

$pedalcms_output  = "<!-- This file is generated by tools/generate-hooks-reference.php in the docs repository. Do not edit by hand. -->\n";
$pedalcms_output .= "# Hooks reference\n\n";
$pedalcms_output .= sprintf(
	"Generated from Pedal CMS %s. This page lists every action and filter the plugin fires, found by scanning the source, so it always matches the code. Each entry shows the arguments in the order they are passed, the plugin version that introduced the hook when the docblock says so, and links to the exact lines that fire it. If you are new to hooks, start with [Working with hooks](hooks.md), then come back here when you need the details.\n\n",
	$pedalcms_version
);
$pedalcms_output .= sprintf(
	"Pedal CMS fires %d actions and %d filters. Names in braces, such as `{\$option}`, are built at runtime. The part in braces is a placeholder for a value you choose when you add your callback.\n\n",
	count( $pedalcms_hooks['action'] ),
	count( $pedalcms_hooks['filter'] )
);

foreach ( [
	'action' => 'Actions',
	'filter' => 'Filters',
] as $pedalcms_kind => $pedalcms_heading ) {
	$pedalcms_output .= '## ' . $pedalcms_heading . "\n\n";

	foreach ( $pedalcms_hooks[ $pedalcms_kind ] as $pedalcms_name => $pedalcms_hook ) {
		$pedalcms_output .= pedalcms_hooks_render_hook( $pedalcms_name, $pedalcms_hook, $pedalcms_ref );
	}
}

fwrite( STDOUT, rtrim( $pedalcms_output ) . "\n" );
