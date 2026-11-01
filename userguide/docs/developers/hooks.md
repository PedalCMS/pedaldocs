# Working with hooks

!!! abstract "What you'll learn"
    - How actions and filters work, in one paragraph.
    - How Pedal CMS names its hooks.
    - Five recipes you can adapt for your own site.
    - How to read the generated hooks reference.

    **Time:** about 20 minutes · **You'll need:** a place to put site code, and a Pedal CMS site with a few programs

## How hooks work

WordPress lets a plugin announce "something is happening here" and lets other code respond. An **action** is an announcement: your callback runs, does something such as printing markup, and returns nothing that matters. A **filter** is a question: the plugin passes a value in, your callback may change it, and it must return a value, or the plugin receives nothing. You attach a callback with `add_action()` or `add_filter()`, giving the hook name, the callback, a priority (lower runs first, the default is 10) and the number of arguments your callback wants. If you ask for fewer arguments than the hook passes, you never see the rest.

## How Pedal CMS names hooks

Every hook starts with `pedalcms/`, followed by a path that describes where it lives:

- `pedalcms/before_main_content` and `pedalcms/after_main_content` sit around the page content.
- `pedalcms/options/...` hooks relate to settings.
- `pedalcms/cassette/...` hooks relate to the field and settings framework.
- `pedalcms/before_template/{$template}` and `pedalcms/after_template/{$template}` are dynamic: the part in braces is replaced by the name of a template, such as `single-program/page-header`.

Two quirks are worth knowing. A few hooks carry a `careers/` segment, such as `pedalcms/careers/main_content_wrapper_class`, a leftover from the plugin's history that has not been renamed. And the forward slashes are intentional; the plugin's coding standards allow them in hook names.

Remember that a hook only works if your callback is registered before the plugin fires it. Put your code at the top level of a theme's `functions.php`, an mu-plugin, or on `plugins_loaded` or `after_setup_theme`, as described in [Configuration](configuration.md).

## Recipe 1: Change the "Back to Top" text

The program sidebar template includes a back-to-top link. Its text goes through `pedalcms/back_to_top_text`, which receives the text and nothing else. The plugin runs the result through `esc_html()`, so return plain text.

```php
add_filter(
	'pedalcms/back_to_top_text',
	function () {
		return __( 'Back to the top of this program', 'riverbend' );
	}
);
```

## Recipe 2: Hide a subpage for some programs

Riverbend's certificate programs are free, so a Cost tab makes no sense for them. Filter `pedalcms/maybe_show_subpage`. It receives `( $show, $subpage, $post_type )`, where `$subpage` is a `Subpage` object, and it runs while WordPress is inside the loop for the program, so `get_the_ID()` works.

```php
add_filter(
	'pedalcms/maybe_show_subpage',
	function ( bool $show, $subpage ): bool {
		if ( 'cost' === $subpage->slug && has_term( 'certificate', 'pedalcms_program_type', get_the_ID() ) ) {
			return false;
		}

		return $show;
	},
	10,
	2
);
```

The tab disappears from the subnav and the subpage template renders nothing. This assumes a Program Type term with the slug `certificate` exists.

## Recipe 3: Add markup before the main content

Pedal CMS wraps its pages in an element it opens on `pedalcms/before_main_content` and closes on `pedalcms/after_main_content`. The plugin's own callbacks, which print the opening and closing tags, are attached at the default priority of 10. Your priority decides where your output lands.

```php
// Inside the wrapper, above the page content.
add_action(
	'pedalcms/before_main_content',
	function () {
		echo '<p class="riverbend-alert">Spring registration is open.</p>';
	},
	20
);
```

Use a priority lower than 10, such as 5, to print before the wrapper opens. These actions take no arguments.

## Recipe 4: Add a class to the content wrapper

The wrapper element gets the classes `pdlcms` and `pdl-template`. To add your own, filter `pedalcms/careers/main_content_wrapper_class`, which receives the class array. You can change the element's id with `pedalcms/main_content_wrapper_id`, and the tag itself is the **Main Content Wrapper Tag** setting.

```php
add_filter(
	'pedalcms/careers/main_content_wrapper_class',
	function ( array $classes ): array {
		$classes[] = 'riverbend';

		return $classes;
	}
);
```

## Recipe 5: Reformat subpage page titles

On a program subpage, the browser tab reads "Curriculum, Nursing (ADN)": the subpage title, a comma, then the program title. To flip it to "Nursing (ADN): Curriculum", filter `pedalcms/subpage_document_title_part`. It receives `( $title_part, $subpage_doc_title, $current_title, $subpage, $title_parts )` and you return the new `title` part.

```php
add_filter(
	'pedalcms/subpage_document_title_part',
	function ( string $title_part, string $subpage_doc_title, string $current_title ): string {
		return $current_title . ': ' . $subpage_doc_title;
	},
	10,
	3
);
```

!!! tip "Teacher's tip"
    When a recipe does not behave, check three things in order: is the callback registered before the hook fires, did you ask for enough arguments in the fourth parameter of `add_filter()`, and does the callback return a value if it is a filter. Those three explain most hook problems.

## Reading the hooks reference

The [Hooks reference](hooks-reference.md) is generated from the plugin source for every release. For each hook it shows:

- the summary and `@since` version from the docblock, when there is one,
- the arguments exactly as they are passed, in order,
- links to every line that fires the hook.

Hooks that have no docblock are still listed, with their arguments and source lines. The arguments are the raw source expressions, so read them as a map of what you receive, not as variable names you must use.

## Try it yourself

Riverbend wants the program sidebar link to say "Top of page" and wants it only on programs in the Program Type `certificate`. Which hook do you use, and what do you need besides the text?

??? success "Check your work"
    Use `pedalcms/back_to_top_text` and test the current post inside the callback.

    ```php
    add_filter(
        'pedalcms/back_to_top_text',
        function ( $text ) {
            if ( is_singular( 'pedalcms_program' ) && has_term( 'certificate', 'pedalcms_program_type', get_the_ID() ) ) {
                return 'Top of page';
            }

            return $text;
        }
    );
    ```

    The filter receives the current text, so return it unchanged when the condition is false.

## Recap

- Actions announce, filters return a value. Always return from a filter.
- Pedal CMS hooks are named `pedalcms/...`, with dynamic names where a template name or option name goes in braces.
- Priorities decide where output lands relative to the plugin's own callbacks.
- The [Hooks reference](hooks-reference.md) lists every hook and links to its source.

**Next:** [PHP API reference](api-reference.md)
