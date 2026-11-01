# Lesson 8: Faculty & staff directory

!!! abstract "What you'll learn"
    - How to turn the directory on or off and set up its page
    - How to add a person, and what every field in **Person Info** does
    - How to group people by personnel category
    - How to connect people to the courses they teach
    - What a profile looks like to visitors

    **Time:** about 20 minutes · **You'll need:** the *Fundamentals of Nursing* course from Lesson 7 (optional but helpful)

## Why this matters

Prospective students want to know who will teach them. Current students want to know whom to email. A directory answers both questions from one place, and because Pedal CMS stores people as their own content type, the same person can appear in the directory, on a program's **Faculty & Staff** tab, on a course page and in a program's contact list. You enter their details once.

## Step 1: Turn the directory on or off

1. Go to **Pedal > Settings** and open the **Directory** tab.
2. The first switch is **Enable Faculty & Staff Directory**, described as "Activate the Personnel post type and archive."

It is on by default. If you switch it off and save, the **Directory** menu disappears and `/directory/` stops working. Programs also stop listing people, because there are no people to list.

## Step 2: Set up the directory page

The **Configure Directory** group sets up `/directory/`, the way the program finder is set up in Lesson 6.

| Field | What it does |
|---|---|
| **Archive Page Title** | The heading of the page. Leave empty to use the content type's own name, **Personnel**. |
| **Archive Page Description** | Introductory text with a full editor. |
| **Archive Featured Image** | A picture in the header. |
| **Archive Header Background Image** | A background behind the header. Only shown in **Tuxedo** presentation mode. |
| **Archive Search Filters** | Choose from **Keyword**, **Personnel Category**, **College** and **Department**. All four are on by default; groupings you have turned off are left out. |

!!! tip "Teacher's tip"
    The default title **Personnel** sounds like a human resources memo. Most colleges prefer something like `Faculty & Staff`. Type it into **Archive Page Title**.

The **Configure Personnel** group has two settings for individual profiles:

| Field | What it does |
|---|---|
| **Personnel Header Background Image** | A background behind every profile's header. Only shown in **Tuxedo** mode. |
| **Courses Taught Label** | The heading above a person's courses. Leave empty for **Courses Taught**. |

## Step 3: Add a person

1. Go to **Directory > Add New**.
2. In the title box, which says **Enter the Full Name**, type the person's name.
3. Write their biography in the main editor.
4. Set a **Featured image** (their photo) in the box on the right.
5. Fill in the **Person Info** box.
6. Click **Publish**.

| Field | What to enter |
|---|---|
| **Job Title** | Their position, such as `Professor of Nursing`. |
| **Office Phone** | A phone number. |
| **Email Address** | A work email address. |
| **Office** | A room or building, such as `Main Building, 448C`. |
| **Person Category** | One category, such as *Faculty* or *Staff*. |
| **College** | The college they belong to. |
| **Department** | Their department. As with programs, when departments depend on colleges you choose the college first. |
| **Related Courses** | Courses they teach. |

For Riverbend, we enter the name `Maya Okafor`, Job Title `Professor of Nursing`, Person Category *Faculty*, College *College of Health Sciences*.

!!! warning "Common mistake"
    Directory lists are sorted alphabetically by the exact text in the title box, and that text is also the name visitors see. `Dr. Maya Okafor` sorts under D, and `Maya Okafor` sorts under M, which means first-name order. Decide on one convention before you add many people, and put titles such as "Dr." in the **Job Title** or the biography.

!!! note
    On a standard installation, people are edited with the classic WordPress editor: a title, a biography box and the **Person Info** box. A site can switch personnel to the block editor, but there is no setting for it on the settings screen. Lesson 11 explains more.

## Step 4: Personnel categories

A **Personnel Category** is how you split the directory into groups such as *Faculty*, *Adjunct Faculty* and *Staff*. Create them under **Directory > Personnel Categories**. A person can have one category.

Categories do two jobs. They give visitors a filter on the directory page, and they provide the headings when a program's **Faculty & Staff** tab has **Group by Category** switched on. They are also hierarchical, so you can nest one inside another, such as *Faculty* containing *Adjunct Faculty*.

Lesson 9 explains how to rename this grouping and how its archive pages work.

## Step 5: Link people and courses

You connected an instructor to a course in Lesson 7. You can also do it from the person's side: open the person, use **Related Courses** in **Person Info**, and update. Either way the link shows up on both screens.

To show people on a program, open the program and:

- **Faculty & Staff** tab, **Related Faculty & Staff**: the people shown on the program's Faculty & Staff subpage.
- **Main** tab, **Related Contacts**: the people shown in the program sidebar under **Program Contact**.

## Step 6: See the profile

A person's page at an address such as `https://riverbend.example/directory/maya-okafor/` shows, near the top:

- their photo, if you set one;
- their name;
- their job title and department;
- their contact details, with labels **Phone**, **Email** and **Office**;

then their biography, and in a sidebar the courses they teach, under your **Courses Taught Label**. Email addresses are lightly scrambled in the page's code to discourage spam harvesters, but they work normally for visitors.

In the directory list, each person appears with their photo, a linked name, job title, department and contact details.

## Try it yourself

Add *Dr. Maya Okafor* as described, give her the office `Health Sciences Building, 210`, link her to *Fundamentals of Nursing*, and make Riverbend's directory page say **Faculty & Staff**. Then make her appear as a contact on *Nursing (ADN)*.

??? success "Check your work"
    1. **Directory > Add New**. Title `Maya Okafor` (the "Dr." belongs in the biography or job title, which keeps sorting consistent). **Job Title** `Professor of Nursing`; **Office** `Health Sciences Building, 210`; **Person Category** *Faculty*; **College** *College of Health Sciences*; **Related Courses** *Fundamentals of Nursing*. **Publish**.
    2. **Pedal > Settings > Directory**, **Archive Page Title** `Faculty & Staff`, **Save Changes**.
    3. Edit *Nursing (ADN)*, **Main** tab, **Related Contacts**, select her, and click **Update**. She appears in the sidebar under **Program Contact**.

## Recap

- **Enable Faculty & Staff Directory** controls the directory and `/directory/`.
- Each person has a title (their name), a biography, a photo and a **Person Info** box.
- People are sorted by the exact text in the title box, so pick one naming convention.
- **Personnel Category** groups people; a person has one.
- People link to courses from either side, and to programs through **Related Faculty & Staff** and **Related Contacts**.
- **Courses Taught Label** renames the courses heading on profiles.

**Next lesson:** [Taxonomies](../organizing/taxonomies.md)
