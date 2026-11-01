# Developer handbook

!!! abstract "What you'll learn"
    - How Pedal CMS starts up and which classes do what.
    - Which post types and taxonomies it registers, and their rewrite slugs.
    - How to read settings and labels from PHP.
    - Where to go next: template overrides, configuration, hooks and the API reference.

    **Time:** about 20 minutes · **You'll need:** comfort with PHP 8.2 and the WordPress plugin API

## Why start with a tour

Before you change how a plugin behaves, it helps to know where its moving parts live. Think of this page as the floor plan you get on the first day in a new building: you will not memorize every room, but you will know which corridor to walk down when you need one.

The examples throughout the handbook continue the fictional **Riverbend Community College** story from the [user guide](../index.md). Riverbend has a developer who needs to tweak what the settings screen cannot, and that developer is you.

## How the plugin starts

Everything begins in `pedalcms.php`. Read it from top to bottom and you will see four steps.

1. It defines `PEDALCMS_VERSION` unless something else defined it first.
2. It loads a fixed list of files: `src/_autoload.php`, `vendor/autoload.php`, `src/cassette.php`, `src/ajax.php`, `src/assets.php`, `src/hooks.php`, `src/shortcodes.php` and `src/breadcrumbs.php`.
3. It waits for `after_setup_theme`, then loads the template tags (`src/template-tags.php` and `src/template-tags-shared.php`). Loading them this late lets a theme define its own functions with the same names first, because each tag is wrapped in `function_exists()`.
4. It creates a `Plugin` object and registers `Plugin::install` as the activation hook.

The `Plugin` constructor does very little: it records the plugin path and URL, then attaches `Plugin::plugin_init` to `init` at priority 4. The real work happens in that method.

## The classes

All classes live in the `PedalCMS\Core` namespace. The autoloader in `src/_autoload.php` maps `PedalCMS\Core\Foo` to `src/class-foo.php`, lowercased, so `SubpageManager` is in `src/class-subpagemanager.php`.

| Class | File | Job |
|---|---|---|
| `Plugin` | `src/class-plugin.php` | Static home for settings (`get_option()`), labels (`get_label()`), the list of enabled post types and taxonomies, and template setup. |
| `CustomContentObject` | `src/class-customcontentobject.php` | Abstract base for everything Pedal CMS registers. A singleton per class: call `Program::get_instance()`, never `new Program()`. |
| `CustomPostType` | `src/class-customposttype.php` | Base for post types. Registers the type and its meta. |
| `CustomTaxonomy` | `src/class-customtaxonomy.php` | Base for taxonomies. Registers the taxonomy against its `$object_types`. |
| `Program`, `Course`, `Person`, `FAQ` | `src/class-program.php` and siblings | The concrete post types. |
| `College`, `Department`, `ProgramType`, `PersonCategory`, `InstructionMode`, `Subject`, `Session`, `FAQCategory` | `src/class-college.php` and siblings | The concrete taxonomies. |
| `Subpage`, `SubpageManager` | `src/class-subpage.php`, `src/class-subpagemanager.php` | Program subpages: the tabs, their URLs, and the decision to show each one. |
| `TemplateManager` | `src/class-templatemanager.php` | Finds and loads templates, checking your theme first. |
| `FilterManager` | `src/class-filtermanager.php` | A registry of archive search filters. |
| `CustomBlock`, `JobTitleBlock`, `ContactInfoBlock` | `src/class-customblock.php` and siblings | The editor blocks used on person pages. |

`Plugin::register_content_model()` is the method that decides what exists on a given site. Programs are always registered. Courses and people are registered only when the `course_enable` and `person_enable` settings allow it, and the FAQ post type is registered when the `faqs` slug appears in `SubpageManager::get_enabled_subpages()`, a list you can change with the `pedalcms/enabled_subpages` filter. Each optional taxonomy checks its own `*_enable` setting the same way. Because the checks run on every request, turning something off in the settings really does remove it.

!!! tip "Teacher's tip"
    Ask `Plugin::post_types()` and `Plugin::taxonomies()` what is active instead of assuming. Both return only the enabled keys by default. Pass `false` to get every key the plugin knows about.

## Settings and fields come from CassetteCMF

Pedal CMS does not use Advanced Custom Fields. The settings page and the meta boxes on programs, courses, people and taxonomy terms are all defined as arrays and handed to [CassetteCMF](https://github.com/PedalCMS/cassette-cmf), the `pedalcms/cassette-cmf` Composer package.

The wiring is in `src/cassette.php`. On `init` at priority 5 it registers four custom field types (`taxonomy`, `relationship`, `conditional_checkbox`, `conditional_number`). On `init` at priority 10 it runs `cassette_init()`, which loads these definition files:

- `src/fields-settings.php`: the settings page, split into tabs.
- `src/fields-program.php`, `src/fields-course.php`, `src/fields-person.php`: the meta boxes for each post type.
- `src/fields-taxonomies.php`: the term fields, keyed by taxonomy.

Each file ends by passing its array through a filter, which is how you extend it. [Configuration](configuration.md) shows how.

## Post types and taxonomies

These are the real keys, taken from the `POST_TYPE` and `TAXONOMY` constants.

| Key | Kind | Front-end URL base | Attached to |
|---|---|---|---|
| `pedalcms_program` | Post type | `/program/` (single), `/programs/` (archive) | n/a |
| `pedalcms_course` | Post type | `/course/` (single), `/courses/` (archive) | n/a |
| `pedalcms_person` | Post type | `/directory/` (single and archive) | n/a |
| `pedalcms_faq` | Post type | `/faq/` (single), `/faqs/` (archive) | n/a |
| `pedalcms_college` | Taxonomy | `/college/` | Programs, people, courses |
| `pedalcms_department` | Taxonomy | none (no rewrite) | Programs, people, courses |
| `pedalcms_program_type` | Taxonomy | `/program-type/` | Programs |
| `pedalcms_person_cat` | Taxonomy | `/personnel-category/` | People |
| `pedalcms_instruct_mode` | Taxonomy | none (no rewrite) | Programs |
| `pedalcms_subject` | Taxonomy | none (no rewrite) | Courses |
| `pedalcms_session` | Taxonomy | none (no rewrite) | Courses |
| `pedalcms_faq_cat` | Taxonomy | none (no rewrite) | FAQs |

Two details trip people up. First, the "Enable Archive" setting can only switch the rewrite off for `pedalcms_college`, `pedalcms_department`, `pedalcms_program_type` and `pedalcms_person_cat`; the department taxonomy never has a rewrite to begin with. Second, a term link for a taxonomy without a rewrite is a query-string link, `/?{query_var}={term-slug}`. The `term_link` filter in `src/hooks.php` swaps the start of such links for the archive URL of the current request's post type, which is why they open a filtered list.

Program subpages add URLs of the form `/program/{program-slug}/{subpage-slug}/`. `SubpageManager::insert_rules()` registers one rewrite rule per subpage, so flush permalinks after you add one.

## Reading settings and labels

Settings are stored as ordinary WordPress options with a `pedalcms_` prefix. Use the accessor, not `get_option()` directly, so the plugin's filters run.

```php
use PedalCMS\Core\Plugin;

// Reads the option "pedalcms_course_enable", falling back to true.
$catalog_enabled = Plugin::get_option( 'course_enable', true );

// The same thing through the template-tag alias.
$catalog_enabled = pedalcms_get_option( 'course_enable', true );
```

Labels are the short front-end strings such as "More Details" or "Apply Now".

```php
// Checks the "label_more_details" setting, then the built-in default, then the filter.
$text = Plugin::get_label( 'more_details' );
```

`Plugin::get_label()` returns a message of the form `Label "key" not found` when the key is unknown, so a typo stands out on the page.

For a custom field value, `Plugin::get_field( $selector, $post_id )` (alias `pedalcms_get_field()`) reads post meta, term meta or a setting depending on `$post_id`. Pass a post ID or `WP_Post` for post meta, a `WP_Term` or a string like `'term_12'` for term meta, and `'option'` for a plugin setting. With no second argument it reads the current post in the loop.

## Where to go next

- [Template overrides](template-overrides.md): change markup from your theme without touching the plugin.
- [Configuration](configuration.md): lock down the settings UI, change options, add fields, register subpages and filters.
- [Working with hooks](hooks.md): how hooks work, plus recipes you can copy.
- [Hooks reference](hooks-reference.md): every action and filter, generated from the source.
- [PHP API reference](api-reference.md): every class and function.

## Recap

- `pedalcms.php` loads a short list of files, then `Plugin::plugin_init()` builds the content model on `init` at priority 4.
- Content types are singletons that extend `CustomPostType` or `CustomTaxonomy`.
- Settings and meta boxes are CassetteCMF arrays in `src/fields-*.php`, each passed through a filter.
- Read settings with `Plugin::get_option()` and labels with `Plugin::get_label()`.

**Next:** [Template overrides](template-overrides.md)
