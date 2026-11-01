# Lesson 1: Installing Pedal CMS

!!! abstract "What you'll learn"
    - What your site needs before you install Pedal CMS
    - How to install and activate the plugin
    - What appears in the dashboard and on the front end after activation
    - What to do if a Pedal CMS page shows "Page not found"

    **Time:** about 10 minutes · **You'll need:** administrator access to a WordPress site running WordPress 6.9 or later and PHP 8.2 or later

## Why this matters

Every lesson that follows assumes a working installation, so let's get this right first. Installing a plugin is routine, but Pedal CMS does a few things at activation that are worth understanding: it creates new content types, gives your Administrator role the permission to manage them, and sets up the web addresses (URLs) where your programs, courses and people will live.

If you know what appears after activation, you will recognize a healthy installation and spot a broken one.

## Step 1: Check your requirements

Pedal CMS needs **WordPress 6.9 or later** and **PHP 8.2 or later**. You can see your WordPress version at **Dashboard > Updates**, and your PHP version at **Tools > Site Health > Info > Server**.

If you are not sure how to change your PHP version, your hosting provider's support team can do it in a few minutes.

## Step 2: Install the plugin

Choose the method that matches how you manage your site.

=== "Upload from the dashboard"

    1. Download `pedalcms.zip` from the plugin's [GitHub Releases page](https://github.com/PedalCMS/pedalcms/releases). Each release has this file attached.
    2. In the dashboard, go to **Plugins > Add New Plugin**.
    3. Click **Upload Plugin**, choose the zip file, and click **Install Now**.

=== "Plugin directory"

    1. Go to **Plugins > Add New Plugin**.
    2. Search for **Pedal CMS**.
    3. Click **Install Now** on the result.

    If the search does not find it, use the upload method instead.

=== "FTP"

    1. Download `pedalcms.zip` and extract it on your computer.
    2. Upload the `pedalcms` folder to your site's `wp-content/plugins/` directory.

## Step 3: Activate

1. Go to **Plugins > Installed Plugins**.
2. Find **Pedal CMS** and click **Activate**.

!!! warning "Common mistake"
    Students often install the plugin and forget to activate it, then wonder why the menu is missing. Installing puts the files on your site; activating switches the plugin on. You need both.

There is no setup wizard. Activation takes you straight back to the Plugins screen, and you configure everything yourself from the settings page, which we visit in the next lesson.

## Step 4: See what changed

Activation adds new items to the left-hand dashboard menu. Take a moment to find them.

| Menu item | What it manages |
|---|---|
| **Pedal** | Your programs. This is also where **Settings** and most of the groupings (colleges, departments, program types, instruction modes) live. |
| **Course Catalog** | Your courses. Present while the course catalog is enabled. |
| **Directory** | Your faculty and staff. Present while the directory is enabled. |
| **FAQs** | Reusable questions and answers. Present while the FAQs subpage is enabled. |

Under **Pedal** you will see **All Programs**, **Add New**, the groupings, and **Settings** at the bottom. The groupings are called taxonomies; Lesson 9 explains them.

You can also reach the settings from the **Plugins** screen: Pedal CMS gets a **Settings** link next to the **Deactivate** link.

## Step 5: Learn the front-end addresses

Pedal CMS builds its public pages at predictable addresses. Replace `riverbend.example` with your own domain.

| What | Address |
|---|---|
| The programs list (the program finder) | `https://riverbend.example/programs/` |
| One program | `https://riverbend.example/program/nursing-adn/` |
| The course catalog | `https://riverbend.example/courses/` |
| One course | `https://riverbend.example/course/{course-slug}/` |
| The directory | `https://riverbend.example/directory/` |
| One person | `https://riverbend.example/directory/{person-slug}/` |

Notice that the list pages use the **plural** (`programs`, `courses`) and a single item uses the **singular** (`program`, `course`). The directory uses `directory` for both. The last part of a single address is the item's **slug**, which WordPress builds from the title (for example, "Nursing (ADN)" becomes `nursing-adn`).

## Step 6: If a page says "Page not found"

WordPress keeps a list of the addresses it understands. Pedal CMS adds its addresses to that list when you activate it and whenever you save the Pedal settings. If you ever see a 404 error on a Pedal page, refresh the list yourself:

1. Go to **Settings > Permalinks**.
2. Click **Save Changes** without changing anything.

!!! warning "Common mistake"
    The **Plain** permalink option does not work well with Pedal CMS, because program subpages need addresses like `/program/nursing-adn/curriculum/`. Pick any other structure, such as **Post name**.

!!! tip "Teacher's tip"
    When something that was working yesterday returns a 404 today, saving **Settings > Permalinks** is the first thing I try. It costs ten seconds and fixes the problem more often than anything else.

## Try it yourself

1. Install and activate Pedal CMS on a test site (a local site or a staging copy is ideal).
2. Find the **Pedal** menu and open its submenu. Write down the names of the items you see.
3. Visit `/programs/` on your site. What do you see, and why?

??? success "Check your work"
    1. After activation, **Pedal** appears in the dashboard menu, and a **Settings** link appears beside Pedal CMS on the Plugins screen.
    2. The **Pedal** submenu lists **All Programs**, **Add New**, the groupings (**Colleges**, **Departments**, **Program Types**, **Instruction Modes**) and **Settings**. You will also see **Course Catalog** and **Directory** in the main menu.
    3. The program finder at `/programs/` loads but shows a message that no programs were found, because you have not added any yet. If you see a 404 instead, save **Settings > Permalinks** and reload.

## Recap

- Pedal CMS needs WordPress 6.9+ and PHP 8.2+, and no other plugins.
- Install from an uploaded zip, the plugin directory or FTP, then **activate**.
- The **Pedal** menu holds programs and **Settings**; **Course Catalog** and **Directory** have their own menus.
- Public addresses are `/programs/`, `/program/{slug}/`, `/courses/`, `/course/{slug}/`, `/directory/` and `/directory/{slug}/`.
- A 404 is usually fixed by saving **Settings > Permalinks**.

**Next lesson:** [A tour of the settings](settings-tour.md)
