# Configuration

!!! abstract "What you'll learn"
    - How to hide the settings screen on a locked-down site.
    - How to override a setting or a label from code.
    - How to add fields to the settings page and to post types.
    - How to register a custom program subpage and a custom archive filter.

    **Time:** about 30 minutes · **You'll need:** a place to put site code, such as a child theme's `functions.php`, an mu-plugin or a small custom plugin

## Why configure in code

The settings screen covers what most sites need. Code takes over when a rule has to hold everywhere: a staging site that must not be edited, a setting that must never change, or a field only your institution uses. Code is also versioned with the rest of your site, so the change travels with every deployment.

Every snippet below is for Riverbend Community College and belongs in your own code, never in the plugin folder.

!!! warning "Common mistake"
    Several of these filters run during `init`. Register your callbacks earlier than that: at the top level of an mu-plugin or `functions.php`, or on `plugins_loaded` or `after_setup_theme`. The field filters in particular must be in place before `cassette_init()` runs on `init` at priority 10, so a callback added on `init` at the default priority is not safe.

## Hiding the settings UI

To remove the settings page and the **Settings** link on the Plugins screen, define the constant in `wp-config.php` before WordPress loads plugins.

```php
define( 'PEDALCMS_DISABLE_SETTINGS_UI', true );
```

To decide at runtime, filter `pedalcms/settings_ui_enabled`. It receives one argument, the current `bool` decision, and the result is cast to `bool`.

```php
add_filter(
	'pedalcms/settings_ui_enabled',
	function ( bool $enabled ): bool {
		return current_user_can( 'manage_network' );
	}
);
```

Only the screen is affected. Stored settings keep working, so you can configure a site first and lock it down afterwards. `Plugin::settings_ui_enabled()` is the method that evaluates both the constant and the filter.

## Overriding a setting

`Plugin::get_option( $option, $fallback )` reads the WordPress option `pedalcms_{$option}` and then runs two filters:

1. `pedalcms/options/all` with `( $value, $option )`
2. `pedalcms/options/{$option}` with `( $value )`

Use the specific filter when you care about one setting. Riverbend wants the content wrapper to always be a `main` element, whatever an administrator chose:

```php
add_filter(
	'pedalcms/options/main_content_wrapper_tag',
	function () {
		return 'main';
	}
);
```

Use the general filter to handle several settings in one place:

```php
add_filter(
	'pedalcms/options/all',
	function ( $value, string $option ) {
		if ( 'display_breadcrumbs' === $option ) {
			return false;
		}

		return $value;
	},
	10,
	2
);
```

Notice that the option name has no `pedalcms_` prefix in either hook. Setting names come from the `name` keys in `src/fields-settings.php`.

!!! tip "Teacher's tip"
    The filters change what the plugin reads, not what is saved. The settings screen will still show the stored value, which can confuse an administrator. Mention the override in a code comment, and in your site's handover notes.

## Changing a label

Front-end strings go through `Plugin::get_label( $label_key )`. The order is: the `label_{$label_key}` setting, then the built-in default in `Plugin::$labels`, then the `pedalcms/get_label` filter. The filter receives `( $label, $label_key, $plugin )`; the third argument is always the string `programs` and is only there for backward compatibility.

```php
add_filter(
	'pedalcms/get_label',
	function ( string $label, string $label_key ): string {
		if ( 'more_details' === $label_key ) {
			return __( 'Learn more', 'riverbend' );
		}

		return $label;
	},
	10,
	2
);
```

The label keys are the array keys in `Plugin::setup_labels()`, such as `more_details`, `apply_now_action` and `back_to_top`.

## Adding fields

Each field definition file ends with a filter that receives the whole array, so you can append to it. The filters are:

| Filter | Receives |
|---|---|
| `pedalcms/cassette/fields/settings` | The settings page fields |
| `pedalcms/cassette/fields/program` | The program meta boxes |
| `pedalcms/cassette/fields/course` | The course meta boxes |
| `pedalcms/cassette/fields/person` | The person meta boxes |
| `pedalcms/cassette/fields/taxonomies` | The term fields, keyed by taxonomy (for example `pedalcms_college`) |

The post type files return a list of top-level items, each normally a `metabox`. To add a field, append a metabox of your own. Riverbend wants a syllabus link on every course:

```php
add_filter(
	'pedalcms/cassette/fields/course',
	function ( array $fields ): array {
		$fields[] = [
			'type'          => 'metabox',
			'name'          => 'riverbend_course_extras',
			'metabox_id'    => 'riverbend_course_extras',
			'metabox_title' => __( 'Riverbend Extras', 'riverbend' ),
			'context'       => 'normal',
			'priority'      => 'default',
			'fields'        => [
				[
					'type'        => 'text',
					'name'        => 'riverbend_syllabus_url',
					'label'       => __( 'Syllabus URL', 'riverbend' ),
					'description' => __( 'Link to the current syllabus PDF.', 'riverbend' ),
				],
			],
		];

		return $fields;
	}
);
```

Read the value in a template with `pedalcms_get_field( 'riverbend_syllabus_url' )` inside the loop, or pass a post ID as the second argument. Post fields are stored as post meta under the field's `name`.

The settings array is nested more deeply: a metabox that holds a `tabs` field, and each tab has an `id` and its own `fields`. Walk down to the tab you want. This adds a campus name to the **General** tab:

```php
add_filter(
	'pedalcms/cassette/fields/settings',
	function ( array $fields ): array {
		foreach ( $fields[0]['fields'][0]['tabs'] as &$tab ) {
			if ( 'general' === $tab['id'] ) {
				$tab['fields'][] = [
					'type'  => 'text',
					'name'  => 'riverbend_campus_name',
					'label' => __( 'Campus name', 'riverbend' ),
				];
			}
		}
		unset( $tab );

		return $fields;
	}
);
```

Setting field names have no prefix in the definition. CassetteCMF stores them as `pedalcms_{name}`, so read this one with `Plugin::get_option( 'riverbend_campus_name' )`. The tab ids are `general`, `programs`, `subpages`, `course_catalog`, `directory` and `taxonomies`.

### The whole CassetteCMF configuration

`cassette_init()` builds one array with the keys `cpts`, `taxonomies` and `settings_pages`, and passes it to `CassetteCMF::register_from_array()`. Three filters let you change parts of it, and one lets you change all of it:

| Filter | Receives |
|---|---|
| `pedalcms/cassette/cpts` | The list of post types and their fields |
| `pedalcms/cassette/taxonomies` | The list of taxonomies and their fields |
| `pedalcms/cassette/settings_pages` | The settings pages (empty when the UI is disabled) |
| `pedalcms/cassette/config` | The complete array |

For example, Riverbend lets its web team, who are not administrators, open the settings page:

```php
add_filter(
	'pedalcms/cassette/config',
	function ( array $config ): array {
		foreach ( $config['settings_pages'] as &$page ) {
			if ( 'pedalcms' === $page['id'] ) {
				$page['capability'] = 'edit_theme_options';
			}
		}
		unset( $page );

		return $config;
	}
);
```

The loop does nothing when the UI is disabled, because `settings_pages` is then an empty array.

## Registering a custom subpage

Program subpages are the tabs on a program page (Curriculum, Cost and so on). You can add your own. The `Program::setup_subpage_manager()` method fires `pedalcms/register_subpages` with the post type key, after the manager exists and before the built-in subpages are added. Call `pedalcms_register_program_subpage()` from that action.

```php
add_action(
	'pedalcms/register_subpages',
	function ( string $post_type ) {
		pedalcms_register_program_subpage(
			'scholarships',
			[
				'title'     => __( 'Scholarships', 'riverbend' ),
				'tab_label' => __( 'Aid', 'riverbend' ),
				'order'     => 55,
			]
		);
	}
);
```

The arguments are the ones the `Subpage` constructor reads: `title`, `document_title`, `tab_label`, `breadcrumb_label`, `aria_label` and `order`. Any label you leave out falls back to `title`. Built-in subpages use orders 10 through 70 in steps of 10, and custom subpages default to 1000. An order of 55 puts the new tab between How to Apply (50) and FAQs (60).

Then supply the template. For the slug `scholarships` it is `scholarships.php` in the `subpages` folder of your theme's override directory:

```php
<?php
// riverbend-child/pedalcms/single-program/subpages/scholarships.php
defined( 'ABSPATH' ) || exit;
?>
<div <?php pedalcms_subpage_class(); ?>>
	<h2 class="program-subpage__title"><?php echo esc_html( pedalcms_subpage_title() ); ?></h2>
	<div class="program-subpage__content">
		<p><?php esc_html_e( 'Ask the financial aid office about scholarships for this program.', 'riverbend' ); ?></p>
	</div>
</div>
```

The program page loads `single-program/subpages/{active-subpage-slug}` automatically, and the new tab appears in the subnav. Flush permalinks (**Settings > Permalinks > Save Changes**) once, because each subpage adds a rewrite rule.

A custom subpage is shown for every program by default. The hooks below let you change that, or change any subpage.

| Hook | Kind | Arguments |
|---|---|---|
| `pedalcms/add_subpage` | filter | `( Subpage $subpage, string $post_type )`. Return the subpage to register. |
| `pedalcms/get_subpages` | filter | `( array $subpages, string $list_name, string $post_type )`. `$subpages` holds `Subpage` objects. `$list_name` is `subpages` or `builtin`. |
| `pedalcms/enabled_subpages` | filter | `( array $slugs, string $post_type, array $subpages )` |
| `pedalcms/maybe_show_subpage` | filter | `( bool $show, Subpage $subpage, string $post_type )` |
| `pedalcms/get_subpage_link` | filter | `( string $link, string $subpage )` |

The docblock for `pedalcms/maybe_show_subpage` calls the second argument a string, but the code passes the resolved `Subpage` object. Check `$subpage->slug` in your callback.

## Registering a custom archive filter

The program, course and directory archives have a search form. `FilterManager` lets you add a control to it and constrain the query. Register it on the `pedalcms/register_filters` action, which fires with no arguments during `plugin_init()`, using the `pedalcms_register_filter()` template tag.

```php
add_action(
	'pedalcms/register_filters',
	function () {
		pedalcms_register_filter(
			'campus',
			[
				'label'     => __( 'Campus', 'riverbend' ),
				'post_type' => 'pedalcms_program',
				'query_var' => 'campus',
				'order'     => 50,
				'render'    => function ( array $context ) {
					$campuses = [
						'north'  => 'North Campus',
						'online' => 'Online',
					];

					printf( '<label for="riverbend-campus">%s</label>', esc_html( $context['label'] ) );
					printf( '<select id="riverbend-campus" name="%s">', esc_attr( $context['query_var'] ) );
					echo '<option value="">' . esc_html__( 'Any campus', 'riverbend' ) . '</option>';
					foreach ( $campuses as $slug => $name ) {
						printf(
							'<option value="%s"%s>%s</option>',
							esc_attr( $slug ),
							selected( $context['value'], $slug, false ),
							esc_html( $name )
						);
					}
					echo '</select>';
				},
				'apply'     => function ( WP_Query $query, string $value ) {
					$query->set(
						'meta_query',
						[
							[
								'key'   => 'riverbend_campus',
								'value' => $value,
							],
						]
					);
				},
			]
		);
	}
);
```

What the keys do, as `FilterManager::register()` defines them:

- `label`: the human-readable name, passed back to your `render` callback.
- `post_type`: a post type or array of them. Leave it empty to apply to all.
- `query_var`: the request variable. It defaults to the slug and is registered through the `query_vars` filter for you.
- `render` or `template`: how to draw the control. `render` is a callable that receives a context array with `filter`, `post_type`, `label`, `query_var` and `value`. `template` is the name of a template part to load with `pedalcms_get_template_part()`.
- `apply`: a callable `( WP_Query $query, string $value )` that runs on the main archive query when the variable is not empty.
- `order`: the sort position among registered filters. The default is 10.

The control is drawn on the `pedalcms/after_filters_fields` action, after the built-in fields, and is only drawn for the post types you listed. This example assumes your courses or programs already store a `riverbend_campus` meta value, for instance from a field you added with the filters above.

## Try it yourself

Riverbend's *Welding Technology* page should show a "Safety certification" tab with the text "Complete the shop safety course before your first lab." Register it so it sits immediately before FAQs, and think about which file you must create.

??? success "Check your work"
    Register a subpage with an order between 50 and 60, for example 58, and create the template in your child theme.

    ```php
    add_action(
        'pedalcms/register_subpages',
        function () {
            pedalcms_register_program_subpage(
                'safety-certification',
                [
                    'title' => __( 'Safety certification', 'riverbend' ),
                    'order' => 58,
                ]
            );
        }
    );
    ```

    The template path is `pedalcms/single-program/subpages/safety-certification.php` in the child theme. Flush permalinks afterwards. To show the tab on *Welding Technology* only, add a `pedalcms/maybe_show_subpage` filter that returns `false` for this slug on other programs. See [Working with hooks](hooks.md) for that pattern.

## Recap

- `PEDALCMS_DISABLE_SETTINGS_UI` or `pedalcms/settings_ui_enabled` hides the settings screen without losing stored values.
- `pedalcms/options/all` and `pedalcms/options/{$option}` override what `Plugin::get_option()` returns; `pedalcms/get_label` overrides labels.
- Field filters receive nested CassetteCMF arrays. Append a metabox for post types and walk to a tab for settings.
- Register subpages on `pedalcms/register_subpages` and archive filters on `pedalcms/register_filters`.

**Next:** [Working with hooks](hooks.md)
