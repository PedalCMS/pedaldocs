# Lesson 3: Look and feel

!!! abstract "What you'll learn"
    - How the three presentation modes differ, and which one to choose
    - How to set your brand color and button text color
    - How to control the size of header images
    - How to avoid duplicate breadcrumbs
    - Why the **Main Content Wrapper Tag** setting exists

    **Time:** about 15 minutes · **You'll need:** access to **Pedal > Settings**, and your institution's brand color as a hex code (for example `#0b5394`)

## Why this matters

Pedal CMS has to live inside your WordPress theme. Your theme already has opinions about fonts, spacing and colors, and the plugin has opinions of its own. The **General** tab is where you decide who wins.

Think of it as choosing a dress code for an event. You can ask everyone to wear formal clothes, to dress casually in a way that blends in, or to come as they are. The three presentation modes work the same way.

## Step 1: Choose a presentation mode

1. Go to **Pedal > Settings** and open the **General** tab.
2. Find **Presentation Mode**.
3. Choose one of the three options.

| Option | What it does |
|---|---|
| **Ghost** | Does not style anything. No Pedal CMS styling is loaded, so your theme decides how everything looks. |
| **Stealth** | Applies only basic styling to handle layout, and blends in with your current theme as much as possible. |
| **Tuxedo** | A more refined and opinionated look. This is the default, and it is recommended for most sites. |

Tuxedo adds the most styling and Ghost adds none. Stealth sits in the middle.

The description under the field says that "additional options will be available when Tuxedo Mode is active." Here is what that means in practice: the **Header Background Image** fields on the **Programs**, **Course Catalog** and **Directory** tabs only appear while Tuxedo is selected, because only Tuxedo draws a background image behind page headers.

!!! tip "Teacher's tip"
    Start with **Tuxedo**. If it fights with your theme, try **Stealth**. Choose **Ghost** only when your developer is writing their own styles, because pages will look plain until someone styles them.

## Step 2: Set your colors

Two color pickers control the colors of links and buttons.

1. **Active Color** is the color used for links and buttons. The default is black (`#000000`).
2. **Button Text Color** is the color of the words on buttons. The default is white (`#ffffff`).

Set **Active Color** to your brand color. Then look at a button on the front end. If white text is hard to read on your color, change **Button Text Color**. A light yellow button needs dark text, for example.

!!! warning "Common mistake"
    Picking a pale brand color and leaving the button text white. The button looks fine in the picker but is unreadable on the page. Always check a real button after you save.

## Step 3: Choose the header image size

**Header Image Size** controls the size of the featured image shown in page headers, such as the picture at the top of a program page.

1. Open the **Header Image Size** drop-down.
2. Choose one of WordPress's standard sizes (thumbnail, medium, medium_large, large, 1536x1536 or 2048x2048), or choose **Custom**.
3. If you chose **Custom**, fill in **Custom Width** and **Custom Height**. Both are measured in pixels.

The default is **Custom** at 450 pixels wide and 336 pixels tall. That is a good starting point for most layouts.

## Step 4: Handle breadcrumbs

Breadcrumbs are the small trail of links, such as *Home > Programs > Nursing (ADN)*, that show visitors where they are.

Pedal CMS does not draw breadcrumbs itself. It asks a breadcrumb plugin to draw them, and it teaches that plugin about program subpages and filtered lists. Four plugins are supported:

- Breadcrumb NavXT
- Yoast SEO
- All in One SEO
- Rank Math

If none of those is active, no breadcrumbs appear from Pedal CMS, and the **Display Breadcrumbs** setting has nothing to turn on or off.

**Display Breadcrumbs** is on by default. Its description says, "Disable this if you have two showing up." That happens when your theme also draws its own breadcrumbs. To fix it, switch **Display Breadcrumbs** off and keep the theme's trail.

## Step 5: Pick the wrapper tag

Pedal CMS wraps its page content in one HTML element. **Main Content Wrapper Tag** lets you choose which: **div** (the default), **main** or **section**.

Why does this matter? Screen readers and other assistive technology use a page's `main` element to let visitors jump straight to the central content. Some themes do not mark up their content area that way. The setting's own description says, "Switch to 'main' to fix accessibility issues with some themes."

!!! warning "Common mistake"
    A page should have only one `main` element. If your theme already provides one, leave this on **div**. If you are unsure, ask your developer, or test with a screen reader or an accessibility checker after you switch.

## Step 6: Save and look

Click **Save Changes**, then open `/programs/` in another browser tab. Check the colors, the header and the breadcrumbs.

## Try it yourself

Riverbend's brand color is a pale gold, `#f2c80d`, and the theme already shows breadcrumbs on every page. Describe the settings you would change on the **General** tab.

??? success "Check your work"
    - Set **Active Color** to `#f2c80d`.
    - Set **Button Text Color** to a dark color such as `#1a1f23`, because white text on pale gold is hard to read.
    - Switch **Display Breadcrumbs** off, so visitors do not see two trails.
    - Leave **Presentation Mode** on **Tuxedo** unless it clashes with the theme, and leave **Main Content Wrapper Tag** on **div** unless you have an accessibility reason to change it.

## Recap

- **Presentation Mode** has three choices: **Ghost** (no styling), **Stealth** (basic layout styling) and **Tuxedo** (full styling, the default).
- **Active Color** and **Button Text Color** control links and buttons; check contrast on a real button.
- **Header Image Size** defaults to **Custom**, 450 by 336 pixels.
- Breadcrumbs come from NavXT, Yoast SEO, All in One SEO or Rank Math; switch **Display Breadcrumbs** off if two trails appear.
- **Main Content Wrapper Tag** is **div**, **main** or **section**; use **main** only if your theme has no main element.

**Next lesson:** [Your first program](../programs/first-program.md)
