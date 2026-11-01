# Lesson 2: A tour of the settings

!!! abstract "What you'll learn"
    - Where the Pedal CMS settings live
    - What each of the six tabs is for
    - How saving works, and what to expect after you save

    **Time:** about 10 minutes · **You'll need:** Pedal CMS activated, and an Administrator account

## Why this matters

Almost everything you can customize in Pedal CMS lives on one screen. Before we change anything, let's walk through it once, the way you would walk through a new building before moving in. You do not need to remember every field. You only need to know which tab to open when someone asks, "Can we rename that?" or "Can we turn that off?"

## Step 1: Open the settings page

1. In the dashboard menu, click **Pedal**.
2. Click **Settings** at the bottom of the submenu.

The page is titled **Pedal CMS Settings**. You can also reach it from the **Plugins** screen by clicking the **Settings** link next to Pedal CMS.

!!! warning "Common mistake"
    The settings are under **Pedal**, not under **Settings** in the main dashboard menu. If you look in the wrong place you will conclude the plugin has no settings page. Only users who can manage options (Administrators) see the page.

!!! note
    If you cannot find the settings page at all, your developer may have hidden it on purpose to lock the configuration down. Ask them. Your saved settings keep working either way.

## Step 2: Meet the six tabs

Across the top of the page you will see six tabs. Here is what each one is for.

| Tab | What it controls | Covered in |
|---|---|---|
| **General** | How the plugin looks: presentation mode, colors, header image size, breadcrumbs, the wrapper tag around page content | [Lesson 3](look-and-feel.md) |
| **Programs** | The program finder page, the default program image, application deadlines, and the Request Info, Apply Now and Contact buttons | Lessons [4](../programs/first-program.md) and [6](../programs/program-finder.md) |
| **Subpages** | Which program subpages exist, and their titles and tab labels | [Lesson 5](../programs/subpages.md) |
| **Course Catalog** | Turn the catalog on or off, set up its page, and rename credit and instructor labels | [Lesson 7](../courses/course-catalog.md) |
| **Directory** | Turn the faculty and staff directory on or off, set up its page, and label courses taught | [Lesson 8](../directory/faculty-staff.md) |
| **Taxonomies** | Turn each grouping (College, Department and so on) on or off, rename it, and choose where it is used | [Lesson 9](../organizing/taxonomies.md) |

Click through each tab now and look at the fields. Some fields only appear when another is set a certain way. For example, **Custom Width** and **Custom Height** on the General tab appear only when **Header Image Size** is **Custom**. That is normal.

## Step 3: Understand empty fields

Many text fields show gray placeholder text, such as **Request Info** in the **Request Info Button Text** box. Placeholder text is not a saved value. It shows you the wording the plugin uses when you leave the field empty.

That gives you a simple rule: leave a field empty to keep the default wording, and type something to replace it.

!!! tip "Teacher's tip"
    Change one thing at a time while you are learning. Save, look at the front end, then change the next thing. If something looks wrong you will know exactly which change caused it.

## Step 4: Save

1. Scroll to the bottom of the page.
2. Click **Save Changes**.
3. Look for the **Settings saved.** message at the top.

All six tabs are saved together. You can edit three tabs and click **Save Changes** once. But if you switch to another screen without saving, your edits are lost.

Saving also tells WordPress to refresh its list of addresses, which matters when you turn the catalog, the directory or a subpage on or off. You do not need to visit **Settings > Permalinks** afterward in the normal case.

## Try it yourself

Riverbend's web team asks you three questions. For each one, name the tab you would open.

1. "Can we stop showing the directory?"
2. "Can we call the **Curriculum** tab on program pages **Courses You'll Take**?"
3. "Can the Apply Now button go to our admissions portal?"

??? success "Check your work"
    1. **Directory** tab, using **Enable Faculty & Staff Directory**.
    2. **Subpages** tab, in the **Curriculum** group, using **Tab Label**.
    3. **Programs** tab, using **Apply Now URL**.

## Recap

- Settings live at **Pedal > Settings**, and the page is titled **Pedal CMS Settings**.
- There are six tabs: **General**, **Programs**, **Subpages**, **Course Catalog**, **Directory** and **Taxonomies**.
- Gray placeholder text shows the default wording; an empty field uses it.
- One **Save Changes** button saves every tab.
- If the page is missing, your developer may have hidden it.

**Next lesson:** [Look and feel](look-and-feel.md)
