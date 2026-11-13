# The terms grid shortcode

!!! abstract "In this guide"
    - What a shortcode is, and what `[pedalcms_terms_grid]` shows
    - Every option the shortcode accepts, with its default
    - How to build three practical grids: colleges, program types and personnel categories
    - The handful of traps to avoid in the current version

    **Time:** about 20 minutes · **You'll need:** a few colleges or program types with a short description and a featured image, and some published programs assigned to them

## Background

The program search lists programs. Sometimes you want a different doorway: a homepage section that says "Explore our colleges" with a picture, a sentence and a link for each one. That is what the terms grid is for. It turns a grouping into a neat grid of cards.

A **shortcode** is a short instruction in square brackets that you place in a page. When the page loads, WordPress replaces the instruction with the content it stands for. You write the instruction once and Pedal draws the grid.

## Place the shortcode

1. Edit the page where the grid should appear, such as your home page.
2. Add a **Shortcode** block (or type directly in the classic editor).
3. Type the shortcode, for example:
    ```text
    [pedalcms_terms_grid tax="pedalcms_college"]
    ```
4. Update the page and view it.

Each card shows the term's name as a link, its featured image, its description and a link such as **Explore 3 Posts**. A card with no image shows no picture, and a card with no description shows an empty space.

!!! warning "Common issue"
    Only terms that are in use appear. A college with no programs, courses or people attached will not show up in the grid, which can make it look as if the shortcode is broken. Assign at least one item to each term.

## Specify the grouping with `tax`

The `tax` option is the only required one. It tells the grid which grouping to display. Use the grouping's **full name**, exactly as in this table:

| Grouping | Value for `tax` |
|---|---|
| College | `pedalcms_college` |
| Department | `pedalcms_department` |
| Program Type | `pedalcms_program_type` |
| Instruction Mode | `pedalcms_instruct_mode` |
| Subject | `pedalcms_subject` |
| Session | `pedalcms_session` |
| Personnel Category | `pedalcms_person_cat` |
| FAQ Category | `pedalcms_faq_cat` |

Short names such as `college` do not work. If you leave `tax` out, the page shows a short message asking for it, which is easy to spot.

Featured images come from the term's own **Featured Image** field, which exists for colleges, departments, program types and personnel categories.

!!! warning "Common issue"
    If `tax` names a grouping that does not exist, or one you have switched off on the **Taxonomies** tab, the page can fail with a "critical error" instead of a friendly message. If a page breaks after you add the shortcode, check the spelling of `tax` and check the grouping is enabled.

## All the options

| Option | Default | What it does |
|---|---|---|
| `tax` | none (required) | The grouping to display. See Step 2. |
| `title_tag` | `h2` | The HTML tag for each card's heading. Use `h1` to `h6`, `p` or `div`. Anything else becomes `h2`. If you choose a heading tag (e.g. `h2`, `h3`, etc), make sure to pick the next level under or equivalent to the previous heading. Skipping heading levels (e.g. putting an `h4` under an `h2` is an accessibility issue). |
| `show_image` | `1` (on) | Show each term's featured image. Use `0` to hide. |
| `show_description` | `1` (on) | Show each term's description. Use `0` to hide. |
| `show_num_posts` | `1` (on) | Put the number of items in the link. Use `0` to hide the number. |
| `show_posts_link` | `1` (on) | Show the link at the bottom of each card. Use `0` to hide. |
| `label_posts` | `Posts` | The word after the number in the link, such as `Programs`. |
| `label_posts_single` | `Post` | The label to use when there is only a single post in the group. |
| `label_sr_text` | `in %s` | Hidden text for screen readers, such as "in College of Health Sciences". Use `%s` as a placeholder for the term's name. |
| `posts_link_prefix` | `Explore` | The word before the number in the link. |
| `wrapper_class` | empty | An extra CSS class for the grid, for developers and theme designers. |
| `columns` | `3` | The number of columns, from 1 to 4. Higher numbers become 4 and lower become 1. |
| `image_size` | `medium` | The WordPress image size for the pictures, such as `thumbnail`, `medium` or `large`. |

The link at the bottom of each card is built from three of these: `posts_link_prefix`, the number, then `label_posts`. With the defaults it reads **Explore 3 Posts**. With `label_posts="Programs"` it reads **Explore 3 Programs**.

!!! warning "Common issue"
    Switch options off with `0`, not with the word `false` or `off`. Shortcode options are plain text, and the grid treats the text `false` as "on". The grid then keeps the thing you wanted to hide. The value `0` (or empty quotes) works.

## Examples

### Example 1: A grid of colleges for the home page

```text
[pedalcms_terms_grid tax="pedalcms_college" columns="2" show_num_posts="0" posts_link_prefix="Explore" label_posts="programs" label_sr_text="in %s"]
```

Colleges are shared by programs, courses and people, so the number in the link would count all three. We turn the number off with `show_num_posts="0"`, and the link reads **Explore programs**, followed by a hidden "in College of Health Sciences" for screen readers.

!!! tip "Tip"
    Use the number only for groupings that apply to one kind of content, such as Program Type. For College and Department, the count mixes programs, courses and people.

### Example 2: Program types with smaller headings

```text
[pedalcms_terms_grid tax="pedalcms_program_type" columns="3" title_tag="h3" label_posts="Programs" label_sr_text="in %s"]
```

Program types apply only to programs, so the count is meaningful: **Explore 4 Programs**. We use `h3` headings because the page already has an `h2` heading above the grid.

### Example 3: A compact list of staff groups

```text
[pedalcms_terms_grid tax="pedalcms_person_cat" columns="4" show_image="0" show_description="0" posts_link_prefix="Meet" label_posts="people" label_sr_text="in %s"]
```

With the images and descriptions off, each card is a name and a link, such as **Meet 12 people**. Where a term's page does not exist, because **Enable Archive** is off, the link leads to the filtered directory instead (Lesson 9).

## If the grid looks unstyled

The grid's styles load only on a single page or post whose content includes the shortcode, and only when **Presentation Mode** is not **Ghost**. They do not load for a shortcode placed in a widget or a block-theme template. A grid that appears without styles is usually in one of those spots, or the shortcode is the very first thing in the content. Put a heading or a sentence of text before it.
