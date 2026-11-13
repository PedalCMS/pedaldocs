# A tour of the settings

!!! abstract "In this guide"
    - Where the Pedal settings live
    - What each of the six tabs is for
    - How saving works, and what to expect after you save

    **Time:** about 10 minutes · **You'll need:** Pedal activated, and an Administrator account

## Open the settings page

1. In the dashboard menu, click **Pedal**.
2. Click **Settings** at the bottom of the submenu.

The page is titled **Pedal Settings**. You can also reach it from the **Plugins** screen by clicking the **Settings** link next to Pedal.

!!! warning "Common issue"
    The settings are under **Pedal**, not under **Settings** in the main dashboard menu. Note that only users who can `manage_options` (Administrators) will see the page.

!!! note
    If you cannot find the settings page at all and you are working with a developer, they may have hidden it on purpose to lock the configuration down. Check with them. Your saved settings keep working either way.

## The settings tabs

Across the top of the page you will see six tabs. Here is what each one is for.

| Tab | What it controls | Covered in |
|---|---|---|
| **General** | How the plugin looks: presentation mode, colors, header image size, breadcrumbs, the wrapper tag around page content | [Look and feel](look-and-feel.md) |
| **Programs** | The program search page, the default program image, application deadlines, and the Request Info, Apply Now and Contact buttons | [First program](../programs/first-program.md) and [Program search](../programs/program-search.md) |
| **Subpages** | Which program subpages exist, and their titles and tab labels | [Program Subpages](../programs/subpages.md) |
| **Course Catalog** | Turn the catalog on or off, set up its page, and rename credit and instructor labels | [Course Catalog](../courses/course-catalog.md) |
| **Directory** | Turn the faculty and staff directory on or off, set up its page, and label courses taught | [Faculty & Staff](../directory/faculty-staff.md) |
| **Taxonomies** | Turn each grouping (College, Department and so on) on or off, rename it, and choose where it is used | [Taxonomies](../organizing/taxonomies.md) |

!!! note 
    Some fields only appear when another is set a certain way. For example, **Custom Width** and **Custom Height** on the General tab appear only when **Header Image Size** is **Custom**. These are conditional fields. 

## Understand empty fields

Many text fields show gray placeholder text, such as **Request Info** in the **Request Info Button Text** box. Placeholder text is not a saved value. It shows you the wording the plugin uses when you leave the field empty.

That gives you a simple rule: leave a field empty to keep the default wording, and type something to replace it.

!!! tip "Tip"
    Change one thing at a time while you are exploring the platform. Save, look at the front end, then change the something else. If something looks wrong, you will know exactly which change caused it.

## Save

1. In the top right corner of the page, click the **Save Changes** button.
2. Look for the **Settings saved.** message at the top.

All six tabs are saved together. You can edit multiple tabs and click **Save Changes** once. But if you switch to another screen without saving, your edits will be lost.

Saving the settings also tells WordPress to refresh its list of addresses/URLs, which matters when you turn the catalog, the directory or a subpage on or off. You do not need to visit **Settings > Permalinks** afterward in the normal case.

**Next up:** [Look and feel](look-and-feel.md)
