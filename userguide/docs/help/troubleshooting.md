# Troubleshooting

Every instructor has a list of the questions students ask most often. This is ours. Each answer points back to the lesson that explains the feature in full. Work from the top of an answer downward, because the most common cause comes first.

## A Pedal CMS page says "Page not found" (404)

**Why it happens:** WordPress keeps a list of the web addresses it understands. If the list is out of date, addresses such as `/programs/` or `/program/nursing-adn/curriculum/` show a 404.

**What to try:**

1. Go to **Settings > Permalinks** and click **Save Changes** without changing anything.
2. Check that the permalink structure is not **Plain**. Program subpages need a structure such as **Post name**.
3. If the missing page belongs to the course catalog, the directory or a subpage, check that the feature is switched on (see below).

See [Lesson 1](../getting-started/installing.md).

## A program's subpage tab is missing

There are three possible causes. Check them in this order.

1. **It is off for the whole site.** Go to **Pedal > Settings > Subpages** and check **Enabled Program Subpages**.
2. **It is off for this program.** Edit the program, open the subpage's tab in **Program Info**, and check that the **Show ... Section** switch (for example **Show Cost Section**) is on.
3. **The program was never saved in the editor.** Programs created by an import or script may have no saved switches, and then every subpage tab is hidden. Open the program and click **Update** once.

See [Lesson 5](../programs/subpages.md).

## The Careers tab is empty

The **Related Careers** list chooses from a content type called `pedalcms_career`, and Pedal CMS does not create that content type. Unless a separate careers add-on provides it, the **Careers** tab can show only its lead text. If you do not use careers, switch the subpage off under **Pedal > Settings > Subpages**.

See [Lesson 5](../programs/subpages.md).

## I see two sets of breadcrumbs

Your theme and Pedal CMS are both drawing them. Go to **Pedal > Settings > General** and switch **Display Breadcrumbs** off. If you see none at all, make sure one of the supported breadcrumb plugins (Breadcrumb NavXT, Yoast SEO, All in One SEO or Rank Math) is active, because Pedal CMS draws no breadcrumbs without one.

See [Lesson 3](../getting-started/look-and-feel.md).

## Pedal CMS clashes with my theme's styling

Try a lighter **Presentation Mode** under **Pedal > Settings > General**:

- **Stealth** applies only basic layout styling and blends in with your theme.
- **Ghost** loads no Pedal CMS styling at all.

If the colors are the problem rather than the layout, adjust **Active Color** and **Button Text Color** first.

See [Lesson 3](../getting-started/look-and-feel.md).

## I can't find the settings page

1. Look under **Pedal** in the left-hand menu. The settings are at **Pedal > Settings**, not under the main **Settings** menu.
2. Check the **Settings** link beside Pedal CMS on the **Plugins** screen.
3. Make sure you are signed in as an Administrator. The page needs the permission to manage options.
4. If none of that helps, your developer may have hidden the settings page on purpose. Ask them.

See [Lesson 2](../getting-started/settings-tour.md).

## A search filter isn't showing on the finder, catalog or directory

1. Check the grouping is enabled under **Pedal > Settings > Taxonomies**. Disabled groupings never appear as filters.
2. Check the filter's switch is on in **Search Filters** on the matching tab (**Programs**, **Course Catalog** or **Directory**). If you disabled a grouping and re-enabled it, switch the filter on again.
3. Remember that each page offers only certain filters. For example, the program finder has no **Subject** filter, and the directory has no **Instruction Mode** filter.

See [Lesson 6](../programs/program-finder.md) and [Lesson 9](../organizing/taxonomies.md).

## The Course Catalog or Directory menu has disappeared

They can be switched off. Go to **Pedal > Settings**, open the **Course Catalog** tab and check **Enable Course Catalog**, or open the **Directory** tab and check **Enable Faculty & Staff Directory**. Save, and the menu returns. If the public page still shows a 404, save **Settings > Permalinks**.

See [Lesson 7](../courses/course-catalog.md) and [Lesson 8](../directory/faculty-staff.md).

## The FAQs menu has disappeared

The FAQ content type exists only while the **FAQs** subpage is enabled. Switch it on under **Pedal > Settings > Subpages**.

See [Lesson 10](../organizing/faqs.md).

## A button doesn't appear on a program page

A button appears only when it has an address. Set **Apply Now URL**, **Request Info URL** or **Contact URL** under **Pedal > Settings > Programs**, or set the first two on the individual program. For a course, the **Register** button needs a **Registration Search URL**.

See [Lesson 4](../programs/first-program.md) and [Lesson 7](../courses/course-catalog.md).

## My button address still contains `$program_guid`

In version 0.6.7, the address fields remove curly braces when you save, so `{$program_guid}` becomes `$program_guid`, and the placeholder is not replaced. Use a plain address on the settings page and set program-specific addresses on each program, or ask your developer to set the pattern from code.

See [Lesson 4](../programs/first-program.md).

## The Department list is empty when I edit a program

When **Depends on College** is on, the **Department** list shows only departments belonging to the chosen college. Choose the **College** first. If the list still says **No departments found**, edit the department under **Pedal > Departments** and check that its **College** is set.

See [Lesson 9](../organizing/taxonomies.md).

## A page shows a "critical error" after I add the terms grid shortcode

Check the spelling of `tax` (it needs the full name, such as `pedalcms_college`) and that the grouping is enabled. Also add `label_sr_text="in %s"` to the shortcode, because the built-in default can stop the page. If the grid appears without styling, put some text before the shortcode.

See [Lesson 12](../extras/terms-grid-shortcode.md).

## Job Title and Contact Info blocks are missing from the editor

Those blocks exist only when personnel use the block editor, which is not the default and has no switch on the settings page. Use the **Person Info** box instead.

See [Lesson 11](../extras/blocks.md).

## A program page is missing its content in a block theme

Check the template in the Site Editor (**Appearance > Editor > Templates**). It should contain one **PedalCMS Template** block. If it was deleted, ask your developer or reset the template to its default.

See [Lesson 11](../extras/blocks.md).

## Still stuck?

If your problem is not listed, note what you expected, what happened, and which page it happened on. Developers can find more detail in the [Developer handbook](../developers/index.md).
