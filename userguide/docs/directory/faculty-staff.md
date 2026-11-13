# Faculty & staff directory

!!! abstract "In this guide"
    - How to turn the directory on or off and set up its page
    - How to add a person, and what every field in **Person Info** does
    - How to group people by personnel category
    - How to connect people to the courses they teach
    - What a profile looks like to visitors

    **Time:** about 20 minutes · **You'll need:** the *Fundamentals of Nursing* course from Lesson 7 (optional but helpful)

## Background

Seeing the friendly faces of the people that prospective students will be working with and learning from humanizes your institution's programs and can increase conversion rates from prospect to applicant. 

The faculty & staff directory in Pedal stores people as their own content type. The same person can appear in the directory, on a program's **Faculty & Staff** tab, on a course page and in a program's contact list. You only enter their details once. 

## Turn the directory on or off

1. Go to **Pedal > Settings** and open the **Directory** tab.
2. The first switch is **Enable Faculty & Staff Directory**, described as "Activate the Personnel post type and archive."

It is on by default. If you switch it off and save, the **Directory** menu disappears and `/directory/` stops working. Programs also stop listing people, because there are no people to list, though it does not disable the **Faculty & Staff** subpage. 

## Set up the directory page

The **Configure Directory** group sets up `/directory/`, the same way that the program search is set up.

| Field | What it does |
|---|---|
| **Archive Page Title** | The heading of the page. Leave empty to use the content type's own name, **Personnel**. |
| **Archive Page Description** | Introductory text with a full editor. |
| **Archive Featured Image** | A picture in the header. |
| **Archive Header Background Image** | A background behind the header. Only shown in **Tuxedo** presentation mode. |
| **Archive Search Filters** | Choose from **Keyword**, **Personnel Category**, **College** and **Department**. All four are on by default; groupings you have turned off are left out. |

!!! tip "Tip"
    The default title **Personnel** sounds like a human resources memo. Most institutions prefer something like `Faculty & Staff`. Type it into **Archive Page Title**.

The **Configure Personnel** group has two settings for individual profiles:

| Field | What it does |
|---|---|
| **Personnel Header Background Image** | A background behind every profile's header. Only shown in **Tuxedo** mode. |
| **Courses Taught Label** | The heading above a person's courses. Leave empty for **Courses Taught**. |

## Add a person

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

!!! warning "Common issue"
    Directory lists are sorted alphabetically by the exact text in the title box, and that text is also the name visitors see. `Dr. Maya Okafor` sorts under D, and `Maya Okafor` sorts under M, which means first-name order. Decide on one convention before you add many people, and put titles such as "Dr." in the **Job Title** or the biography.

## Personnel categories

A **Personnel Category** is how you split the directory into groups such as *Faculty*, *Adjunct Faculty* and *Staff*. Create them under **Directory > Personnel Categories**. A person can have one category.

Categories do two jobs. They give visitors a filter on the directory page, and they provide the headings when a program's **Faculty & Staff** tab has **Group by Category** switched on. They are also hierarchical, so you can nest one inside another, such as *Faculty* containing *Adjunct Faculty*.

Lesson 9 explains how to rename this grouping and how its archive pages work.

## Link people and courses

You connected an instructor to a course in Lesson 7. You can also do it from the person's side: open the person, use **Related Courses** in **Person Info**, and update. Either way the link shows up on both screens.

To show people on a program, open the program and:

- **Faculty & Staff** tab, **Related Faculty & Staff**: the people shown on the program's Faculty & Staff subpage.
- **Main** tab, **Related Contacts**: the people shown in the program sidebar under **Program Contact**.

## The personnel profile

A person's page at an address such as `https://riverbend.example/directory/maya-okafor/` shows, near the top:

- their photo, if you set one;
- their name;
- their job title and department;
- their contact details, with labels **Phone**, **Email** and **Office**;

then their biography, and in a sidebar the courses they teach, under your **Courses Taught Label**. Email addresses are lightly scrambled in the page's code to discourage spam harvesters, but they work normally for visitors.

In the directory list, each person appears with their photo, a linked name, job title, department and contact details.

**Next up:** [Taxonomies](../organizing/taxonomies.md)
