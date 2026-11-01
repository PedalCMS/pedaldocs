# Lesson 4: Your first program

!!! abstract "What you'll learn"
    - How to add a program and what every field on the **Main** tab does
    - How the Request Info, Apply Now and Contact buttons get their addresses
    - How application deadlines work, from site-wide to per-program
    - How to set a default featured image for programs

    **Time:** about 20 minutes · **You'll need:** Pedal CMS activated; ideally one College and one Program Type already created (Lesson 9 explains them, but you can add one quickly under **Pedal > Colleges** and **Pedal > Program Types**)

## Why this matters

Programs are the heart of Pedal CMS. Everything else in the plugin, from courses to people, exists to support a program page that helps a prospective student decide, "Is this for me, and how do I start?"

A program has two kinds of information. Some of it belongs to the program alone, such as its overview text. Some of it is shared across the whole site, such as the address of your admissions form. Pedal CMS lets you set the shared values once on the settings page and override them on individual programs. Keeping that idea in mind makes this lesson much easier.

## Step 1: Create the program

We will create *Nursing (ADN)* at Riverbend.

1. Go to **Pedal > Add New**.
2. Type the program name in the title box: `Nursing (ADN)`.
3. Optionally, set a **Featured image** in the box on the right. It appears in the page header and in the program finder when images are turned on.

Notice what is missing: there is no big text editor. Program content goes into the **Program Info** box below the title, which has a row of tabs: **Main**, **Curriculum**, **Careers**, **Faculty & Staff**, **Cost**, **Apply**, **FAQs** and **News**. This lesson covers **Main**. Lesson 5 covers the others.

## Step 2: Fill in the Main tab

Work through the **Main** tab from top to bottom.

| Field | What to enter |
|---|---|
| **Program GUID** | A globally unique identifier that links this program to other systems, such as your application system. Use whatever code your admissions office uses, for example `NURS-ADN`. Leave it empty if you do not have one. |
| **College** | Choose the college that owns the program, such as *College of Health Sciences*. |
| **Department** | Choose a department. If Departments depend on Colleges on your site, pick the college first; the department list then shows only that college's departments. |
| **Program Type** | Choose one type, such as *Associate Degree*. |
| **Instruction Mode** | Choose how it is taught, such as *In-person*, *Online* or *Hybrid*. |
| **Prerequisites** | A switch, on by default. The program page shows **Prerequisites: Yes** when it is on and **No** when it is off. |
| **Overview Content** | The text of the program's main page. Use headings, lists and images as in any WordPress editor. |
| **Request Info URL** | Optional. Overrides the site-wide address for this one program. |
| **Apply Now URL** | Optional. Overrides the site-wide address for this one program. |
| **Contact Us URL** | See the note below. |
| **Show Application Deadlines** | A switch, on by default. |
| **Application Deadlines** | A list of deadlines for this program. Click **Add Deadline**, then fill in **Label** (for example *Fall*) and **Info** (for example *June 24th*). |
| **Related Contacts** | People from your directory who answer questions about this program. They appear in the program sidebar. |

!!! warning "Common mistake"
    **Prerequisites** is only a Yes or No switch. It does not hold a list of required courses. Write the actual requirements in **Overview Content** or on another subpage, and use the switch to flag that prerequisites exist.

!!! note "Contact Us URL"
    In version 0.6.7 the **Contact** button on a program takes its address from the site-wide **Contact URL** on the **Programs** tab. The per-program **Contact Us URL** field exists on the form, but the page does not currently use it. Set the site-wide address, and test the button after you set a per-program one.

4. Click **Publish**.

Visit the new page, which will be at an address like `https://riverbend.example/program/nursing-adn/`. You will see the title, the program type, a short line of details (instruction mode, prerequisites, college, department) and your overview.

## Step 3: Set up the buttons

Program pages have three buttons: **Apply Now** and **Request Info** (together in the sidebar), and **Contact** (below any related contacts). A button only appears when it has an address to go to. If you see no buttons, no address has been set yet.

Addresses are set once for the whole site:

1. Go to **Pedal > Settings** and open the **Programs** tab.
2. Scroll to the **Configure Programs** group.
3. Set the fields you need.

| Field | Purpose |
|---|---|
| **Request Info Button Text** | The words on the button. Leave empty for **Request Info**. |
| **Request Info URL** | Where the button goes. |
| **Apply Now Button Text** | The words on the button. Leave empty for **Apply Now**. |
| **Apply Now URL** | Where the button goes. |
| **Program Contact Label** | The heading above the related contacts. Leave empty for **Program Contact**. |
| **Contact Button Text** | The words on the contact button. Leave empty for **Contact**. |
| **Contact URL** | Where the contact button goes. |

### URL patterns

The three URL fields accept a **pattern** rather than a fixed address. In a pattern you may write `{$program_guid}` and `{$program_slug}`, and Pedal CMS replaces them with the details of whichever program the visitor is looking at.

- `{$program_guid}` becomes the program's **Program GUID**.
- `{$program_slug}` becomes the program's slug, the last part of its web address.

Here is a worked example for Riverbend. The admissions portal accepts a program code in its address:

```text
https://apply.riverbend.example/start?program={$program_guid}
```

For *Nursing (ADN)*, whose **Program GUID** is `NURS-ADN`, the **Apply Now** button goes to:

```text
https://apply.riverbend.example/start?program=NURS-ADN
```

Likewise, the request-info form might use the slug:

```text
https://www.riverbend.example/request-info/?program={$program_slug}
```

For the same program, that becomes `https://www.riverbend.example/request-info/?program=nursing-adn`. Because the pattern is filled in per program, one setting serves every program on the site.

!!! warning "Common mistake"
    In version 0.6.7, the address fields clean up what you type when you save, and that cleaning removes curly braces. After you save, reopen the **Programs** tab and look at the field. If `{$program_guid}` now reads `$program_guid`, the placeholder will not be replaced on your pages. Until that is fixed, use a plain address on the settings page and set program-specific addresses in each program's own **Request Info URL** and **Apply Now URL** fields. Your developer can also set the pattern from code.

If a program has its own **Request Info URL** or **Apply Now URL**, that address wins over the site-wide pattern.

## Step 4: Application deadlines

You can list deadlines in three places, and Pedal CMS picks the most specific one that has content, in this order:

1. The program's own **Application Deadlines** (on the **Main** tab).
2. The program's **Program Type**. When you edit a Program Type under **Pedal > Program Types**, it has its own **Application Deadlines** list, so every *Certificate* can share dates.
3. The site-wide **Application Deadlines** on the **Programs** tab.

Set the site-wide list first, since most programs share the same dates. Then override it only where a program differs. Each list has the same two boxes: a label such as *Fall* and the info such as *June 24th*.

The deadlines appear in the program sidebar under the heading **Application Deadlines**.

!!! tip "Teacher's tip"
    Put your normal dates on the **Programs** tab and leave program-level lists empty. When the dates change next year you will edit one list, not forty programs.

## Step 5: A default featured image

Not every program has a photo ready. On the **Programs** tab, **Default Program Featured Image** lets you pick one image that stands in for any program with no featured image of its own. A program that has its own featured image keeps it.

## Try it yourself

Create *Welding Technology* in the *College of Trades & Technology* as a *Certificate*, taught *In-person*. Give it the **Program GUID** `WELD-CERT`. Its deadlines differ from the site-wide ones: it starts only in the fall, with the deadline *August 1st*. Its **Apply Now** button should use the pattern from this lesson.

??? success "Check your work"
    1. **Pedal > Add New**, title `Welding Technology`.
    2. On the **Main** tab: **Program GUID** `WELD-CERT`; **College** *College of Trades & Technology*; **Program Type** *Certificate*; **Instruction Mode** *In-person*.
    3. Under **Application Deadlines**, click **Add Deadline**; **Label** `Fall`, **Info** `August 1st`. Because the program has its own list, it overrides the site-wide one.
    4. Leave **Apply Now URL** empty on the program, so it uses the site-wide pattern. With the pattern `https://apply.riverbend.example/start?program={$program_guid}` working, the button would go to `https://apply.riverbend.example/start?program=WELD-CERT`.
    5. Click **Publish** and view the page to check the sidebar.

## Recap

- Add programs at **Pedal > Add New**. Content goes in the **Program Info** tabs, starting with **Main**.
- **Prerequisites** is a Yes/No switch, not a text field.
- Button addresses are set site-wide on **Pedal > Settings > Programs** and can use `{$program_guid}` and `{$program_slug}`; check that the braces survive saving.
- A button without an address does not appear.
- Application deadlines come from the program first, then its program type, then the site-wide list.
- **Default Program Featured Image** fills in for programs without a picture.

**Next lesson:** [Program subpages](subpages.md)
