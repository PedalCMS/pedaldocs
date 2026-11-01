# Lesson 6: The program finder

!!! abstract "What you'll learn"
    - What the program finder is and where visitors find it
    - How to give it a title, description, image and header background
    - How to choose which search filters visitors see
    - How the keyword search, filters, result counts and paging behave

    **Time:** about 15 minutes · **You'll need:** at least three programs published, in at least two colleges

## Why this matters

For most visitors the program finder is the front door. They arrive with a vague idea ("something in health care, maybe online") and they want to narrow the list quickly. A good finder page has an inviting heading, a few useful filters and a clean list.

Pedal CMS builds that page automatically at `/programs/`. Your job is to dress it up and decide which filters earn a place.

## Step 1: Look at the default page

Visit `https://riverbend.example/programs/`. From top to bottom you will see:

1. Breadcrumbs, if you use a supported breadcrumb plugin (Lesson 3).
2. A header with the page title, description and image.
3. A row of search filters.
4. A line showing how many programs match, such as **Showing 3 programs.**
5. The list of programs, sorted alphabetically by title.
6. Page links, when there are more programs than fit on one page.

## Step 2: Set up the page header

1. Go to **Pedal > Settings** and open the **Programs** tab.
2. Find the **Configure Program Listings** group.

| Field | What it does |
|---|---|
| **Page Title** | The heading of the page. Leave empty to use the content type's own name, **Programs**. |
| **Page Description** | Introductory text under the heading. It has a full text editor. |
| **Featured Image** | A picture shown in the header. |
| **Header Background Image** | A background picture behind the header. Only shown while **Presentation Mode** is **Tuxedo**. |

For Riverbend, a good title is `Find Your Program`, and a good description is a sentence or two about the school's approach.

The size of the featured image follows **Header Image Size** on the **General** tab.

## Step 3: Choose the search filters

**Search Filters** is a list of switches. Each switch you turn on adds one control to the filter row.

| Filter | Control the visitor sees |
|---|---|
| **Keyword** | A text box |
| **Program Type** | A drop-down |
| **Instruction Mode** | A drop-down |
| **College** | A drop-down |
| **Department** | A drop-down |

All five are on by default. The drop-downs start on a choice such as **Any Program Type**, which means "do not filter by this".

The description under the field reminds you that "disabled taxonomies will not appear." If you turn off, say, **Department** under **Taxonomies** (Lesson 9), it disappears from this list and from the page. Fewer filters are often better. If Riverbend has only two colleges, a **College** drop-down may help, but a **Department** drop-down with a single entry is clutter.

!!! warning "Common mistake"
    If you turn a grouping off and later turn it back on, open **Search Filters** again and check that its switch is still on. Switches for groupings that are off are not part of the saved selection, so a re-enabled filter may need to be switched on again.

## Step 4: Show images in the list (optional)

**Show Images in List View** controls whether each program in the list shows its featured image. It is off by default. If you turn it on, programs without their own picture use the **Default Program Featured Image** from Lesson 4, so the list stays tidy.

## Step 5: See how visitors use it

A visitor can:

1. Type a word in **Keyword**, such as `nursing`.
2. Pick one or more filters, such as **Instruction Mode: Online**.
3. Click **Search**.

The list then shows only the programs that match everything they chose, and the result line gains the label **Filtered Results**, for example **Filtered Results: Showing 1 Program.** When the filters leave nothing, the page says **No programs were found.**

To start over, the visitor clicks **Reset**, which appears once a filter is active.

If a list is long, it is split across pages, and the result line then reads like **Showing 1-10 of 24 programs.** The number of programs per page comes from WordPress's own setting at **Settings > Reading**.

!!! tip "Teacher's tip"
    Test the finder as a visitor would. Open it in a private window, search for a word that appears in only one program title, and try each filter. Ten minutes of testing catches wording problems that you will not see in the dashboard.

## Try it yourself

Riverbend wants the program finder titled **Find Your Program**, with only three filters: **Keyword**, **Program Type** and **Instruction Mode**. Programs should show their pictures.

??? success "Check your work"
    1. **Pedal > Settings > Programs**, **Configure Program Listings** group: set **Page Title** to `Find Your Program`.
    2. In **Search Filters**, leave **Keyword**, **Program Type** and **Instruction Mode** on, and switch **College** and **Department** off.
    3. Switch **Show Images in List View** on.
    4. Click **Save Changes** and visit `/programs/`.

## Recap

- The program finder is at `/programs/`, with filters, a result count and paging.
- **Page Title**, **Page Description**, **Featured Image** and **Header Background Image** (Tuxedo only) dress up the header.
- **Search Filters** chooses which of **Keyword**, **Program Type**, **Instruction Mode**, **College** and **Department** appear; disabled groupings never appear.
- **Show Images in List View** is off by default.
- Visitors use **Search** and **Reset**; the result line says **Filtered Results** when a filter is active.

**Next lesson:** [The course catalog](../courses/course-catalog.md)
