# Template overrides

!!! abstract "What you'll learn"
    - How Pedal CMS chooses a template in classic themes and in block themes.
    - Which templates you can override, and where the copy goes.
    - How to override one part of a page from a child theme.
    - How to add markup around a template without copying it.

    **Time:** about 25 minutes · **You'll need:** a child theme (or a theme you control) and a Pedal CMS site with at least one program

## Why overrides exist

Every page Pedal CMS draws, from the program finder to a faculty profile, is built from small PHP template files in the plugin's `templates/` folder. You could edit those files in place, but the next plugin update would erase your work. Overrides solve that: you copy a file into your theme, change the copy, and Pedal CMS prefers yours.

It is the same idea as a student turning in their own version of a worksheet. The plugin hands out its default, and if your theme has submitted a replacement with the same name, the replacement gets graded.

## How a template is chosen

`Plugin::setup_template_manager()` runs on `init` and decides between two paths. The deciding method is `Plugin::can_register_block_templates()`, which is true only when `register_block_template()`, `register_block_type()` and `wp_is_block_theme()` exist and the active theme is a block theme.

=== "Classic theme"

    A `TemplateManager` is created and hooked to `template_include` at priority `PHP_INT_MAX`, so it runs after everything else. For each enabled post type it knows a `single-*` and an `archive-*` template, and for each enabled taxonomy a `taxonomy-*` template. The first match wins. A program page therefore loads `single-program`, a course archive loads `archive-course`, and so on.

    The names come from `TemplateManager::convert_obj_name_to_template()`, which removes the `pedalcms_` prefix and turns underscores into hyphens: `pedalcms_program_type` becomes `program-type`, so the taxonomy template is `taxonomy-program-type`.

=== "Block theme"

    Pedal CMS registers one block template per content type with `register_block_template()`, under the plugin name `pedalcms` and a slug such as `single-pedalcms_program`. Each template is your theme's header template part, the `pedalcms/template-render` block, and your theme's footer template part.

    The `pedalcms/template-render` block is a server-rendered block whose `name` attribute holds the template name. Its render callback, `Plugin::render_legacy_template_block()`, only renders names that are in the plugin's own template map. It fires `pedalcms/before_main_content`, loads the template through `TemplateManager::load_template()`, then fires `pedalcms/after_main_content`.

    Because the block goes through `load_template()`, overrides in your theme folder work in block themes too. The Site Editor can also customize the block template itself.

!!! warning "Common mistake"
    Do not delete the `PedalCMS Template` block from a block template in the Site Editor. It is the only thing that renders the program, course or person content.

## Where your copy goes

`TemplateManager::locate_template()` looks for a file called `{template}.php` inside a folder named after `Plugin::$name`, which is `pedalcms`. It uses WordPress's own `locate_template()`, so a child theme is checked before its parent. The first file found wins; if there is none, the plugin's file in `templates/` is used.

So the plugin file `templates/single-program/page-header.php` is overridden by:

```text
wp-content/themes/riverbend-child/pedalcms/single-program/page-header.php
```

Keep the sub-folder and the file name exactly as they are in the plugin.

## What you can override

Any file under `templates/` can be overridden. The tree is organized in two levels: entry templates at the top, and folders of parts.

```text
templates/
├── single-program.php        single-course.php        single-person.php
├── archive-program.php       archive-course.php       archive-person.php
├── taxonomy-college.php      taxonomy-department.php
├── taxonomy-program-type.php taxonomy-person-cat.php
├── common/                   shared parts
│   ├── header.php, footer.php, breadcrumbs.php, pagination.php, num-results.php
│   ├── filters.php and filters/ (keyword.php, college.php, department.php, ...)
│   ├── page-header-backdrop.php, post-featured-image.php, terms-grid.php, ...
├── single-program/           page-header.php, subnav.php, program-meta.php,
│   │                         program-actions.php, contact.php, sidebar.php, ...
│   └── subpages/             index.php, curriculum.php, careers.php, faculty-staff.php,
│                             cost.php, apply.php, faqs.php, news.php, lead-content.php
├── archive-program/          page-header.php, filters.php, program-list.php, program-item.php, ...
├── single-course/            page-header.php, course-meta.php, course-actions.php, ...
├── archive-course/           page-header.php, filters.php, course-list.php, course-item.php, ...
├── single-person/            page-header.php, person-meta.php, related-courses.php, ...
├── archive-person/           page-header.php, filters.php, person-list.php, person-item.php, ...
└── blocks/                   contact-info.php, job-title.php
```

Run `find templates -type f | sort` in the plugin folder for the full list at your version.

Entry templates assemble parts with `pedalcms_get_template_part( 'single-program/page-header' )`. That function is an alias of `TemplateManager::load_template()`, so every part you see called this way can be overridden on its own. Override the smallest file that does the job. A one-file override keeps working across plugin updates far longer than a copy of a whole page.

!!! note
    Templates found in your theme are not passed through the `pedalcms/locate_template` filter. That filter only applies when the plugin's own bundled file is used.

## A worked example

Riverbend's marketing team wants a short line under every program title: "A Riverbend Community College program". The title lives in `single-program/page-header.php`. Let's override that one file.

1. In your child theme, create the folder `pedalcms/single-program/`.
2. Copy `templates/single-program/page-header.php` from the plugin into it.
3. Add the line after the `<h1>`. The version below shows the complete file with the addition marked.

```php
<?php
/**
 * Riverbend override of the single program page header.
 */

defined( 'ABSPATH' ) || exit;

$pedalcms_defaults = [
	'link_terms' => true,
];

// $args and $template are provided by TemplateManager::load_template().
$pedalcms_args            = pedalcms_parse_template_args( $args, $pedalcms_defaults, $template );
$pedalcms_args['context'] = $template;

?>
<header class="single-program-page-header page-header entry-header">

	<?php pedalcms_get_template_part( 'common/page-header-backdrop' ); ?>

	<div class="page-header__content">
	<?php pedalcms_get_template_part( 'common/post-featured-image', $pedalcms_args ); ?>

	<div class="page-header__title-group">
		<h1 class="page-title entry-title">
		<?php the_title(); ?>
		</h1>
		<?php /* Added by Riverbend. */ ?>
		<p class="riverbend-tagline">A Riverbend Community College program</p>
		<?php if ( taxonomy_exists( 'pedalcms_program_type' ) ) : ?>
		<div class="program-type taxonomy">
			<?php echo wp_kses_post( pedalcms_get_the_term_list( get_the_ID(), 'pedalcms_program_type', '', ', ', '', $pedalcms_args['link_terms'] ) ); ?>
		</div>
		<?php endif; ?>
	</div>
	<?php pedalcms_get_template_part( 'single-program/program-meta' ); ?>
	<?php pedalcms_get_template_part( 'single-program/subnav' ); ?>
	</div>
</header><!-- .page-header -->
```

Reload a program page such as *Nursing (ADN)* and the line appears. Delete your copy and the plugin's version returns.

!!! tip "Teacher's tip"
    Two variables are always in scope inside a template: `$args` (the data passed in) and `$template` (the name used to load it, such as `single-program/page-header`). `pedalcms_parse_template_args()` merges `$args` over your defaults, and gives the `pedalcms/template_defaults` filter a chance to change those defaults first.

## Changing a template without copying it

An override replaces the whole file. When you only want to add something before or after it, use hooks and leave the file alone. `TemplateManager::load_template()` fires two actions around every template it loads, with the template name at the end of the hook name and the template args as the only argument:

- `pedalcms/before_template/{$template}`
- `pedalcms/after_template/{$template}`

```php
add_action(
	'pedalcms/before_template/single-program/page-header',
	function ( array $args ) {
		echo '<p class="riverbend-notice">Spring applications close March 1.</p>';
	}
);
```

These actions fire whether the template comes from the plugin or from your theme, because they run inside `load_template()` itself. Before it includes the file, `load_template()` also passes the args through the `pedalcms/template_args` filter, which receives `( array $args, string $template )`.

To change a default value rather than the markup, use `pedalcms/template_defaults`, which receives `( array $defaults, string $template, array $args )`. Riverbend can stop program type names from linking in the program header like this:

```php
add_filter(
	'pedalcms/template_defaults',
	function ( array $defaults, string $template ) {
		if ( 'single-program/page-header' === $template ) {
			$defaults['link_terms'] = false;
		}

		return $defaults;
	},
	10,
	2
);
```

The plugin's own settings use the same filter at priority 5 (see `options_template_defaults()` in `src/hooks.php`), so a priority of 10 or later runs after them and wins. Only templates that call `pedalcms_parse_template_args()` honor this filter.

## Try it yourself

Riverbend wants the *Welding Technology* program page to show the line "Hands-on from week one" right after the page header, and no other program page to show it. Without copying any template, add the text with a hook.

??? success "Check your work"
    Use the `after_template` action for the page header. The text is output after the header's closing tag.

    ```php
    add_action(
        'pedalcms/after_template/single-program/page-header',
        function () {
            if ( 'welding-technology' === get_post_field( 'post_name', get_the_ID() ) ) {
                echo '<p>Hands-on from week one</p>';
            }
        }
    );
    ```

    The hook name ends with `single-program/page-header` because that is the name `single-program.php` passes to `pedalcms_get_template_part()`.

## Recap

- Classic themes use `template_include`; block themes use registered block templates that render through the `pedalcms/template-render` block. Both honor overrides in `your-theme/pedalcms/`.
- Override the smallest file that does the job, keeping its folder and name.
- Use `pedalcms/before_template/{$template}` and `pedalcms/after_template/{$template}` to add markup without copying a file.
- Use `pedalcms/template_defaults` to change defaults, and `pedalcms/template_args` to change the data a template receives.

**Next:** [Configuration](configuration.md)
