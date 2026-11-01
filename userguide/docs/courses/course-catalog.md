# Lesson 7: The course catalog

!!! abstract "What you'll learn"
    - How to turn the course catalog on or off
    - How to set up the catalog page and its search filters
    - How to relabel credits, the register button and instructors
    - How to add a course and connect it to instructors, subjects and sessions

    **Time:** about 20 minutes · **You'll need:** a few people in your directory (Lesson 8 shows how; you can come back and link them afterward)

## Why this matters

A program page tells a student what they will study. The course catalog answers the next question: "What is this class, how many credits is it, and when can I take it?"

Pedal CMS treats courses as their own content type so that one course can appear in many places, such as in the curriculum of two different programs, without you retyping it.

!!! note
    The catalog is a marketing tool. It lists courses and links out to your registration system. It does not take registrations itself.

## Step 1: Turn the catalog on or off

1. Go to **Pedal > Settings** and open the **Course Catalog** tab.
2. The first switch is **Enable Course Catalog**. Its description says, "Activate the Course Catalog post type and archive."

It is on by default. If your institution does not want a public catalog, switch it off and click **Save Changes**. The **Course Catalog** menu then disappears and `/courses/` stops working.

!!! warning "Common mistake"
    Program curriculum sections choose their courses from the catalog. If you switch the catalog off, there is nothing to choose from. Keep it on if you use the **Curriculum** subpage.

## Step 2: Set up the catalog page

The **Configure Course Catalog** group works like the program finder (Lesson 6).

| Field | What it does |
|---|---|
| **Page Title** | The heading at `/courses/`. Leave empty to use **Course Catalog**. |
| **Page Description** | Introductory text with a full editor. |
| **Featured Image** | A picture in the header. |
| **Header Background Image** | A background behind the header. Only shown in **Tuxedo** presentation mode. |
| **Search Filters** | Which filters appear: **Keyword**, **Session**, **Subject**, **Instruction Mode**, **College**, **Department**. All six are on by default, and any grouping you have disabled is left out. |

## Step 3: Set the course labels

The **Configure Courses** group adjusts the wording on course pages.

| Field | What it does |
|---|---|
| **Credits Label (plural)** | The unit of measure for course hours, "sometimes called units". Leave empty for **credits**. |
| **Credits Label (singular)** | The same word for one. Leave empty for **credit**. |
| **Register Button Text** | The words on the registration button. Leave empty for **Register**. |
| **Registration Search URL** | Where the registration button goes. |
| **Instructors Label** | The heading above the instructors on a course page. Leave empty for **Instructors**. |

Riverbend calls credits "units", so it enters `units` and `unit`. Remember to fill in both the plural and the singular label.

The **Registration Search URL** can include the placeholder `{$course_reg_key}`. Pedal CMS swaps it for the course's **Course Registration Key**, so a single address can lead to the right course in your registration system. The same warning from Lesson 4 applies: the address field may remove curly braces when you save, so reopen the field and check.

!!! warning "Common mistake"
    The **Register** button appears only when a course has a registration address, either from this setting or from the course's own **Registration Search URL**. An empty address means no button.

## Step 4: Add a course

1. Go to **Course Catalog > Add New**.
2. Enter the course name as the title, for example `Fundamentals of Nursing`.
3. Write a full description in the main editor. It appears on the course page.
4. Fill in the **Course Info** box.

| Field | What to enter |
|---|---|
| **Short Description** | A brief description, "ideally one paragraph or less". It appears on the course page above the full description, and in the catalog list. |
| **Course Code** | Your code, such as `NUR101`. It appears after the title as **Fundamentals of Nursing (NUR101)**. |
| **Credits** | A whole number, such as `4`. |
| **Course Registration Key** | The identifier your registration system uses. It fills `{$course_reg_key}`. |
| **Registration Search URL** | Optional. Overrides the site-wide address for this course. |
| **Related Personnel** | The people who teach the course. |

5. In the boxes on the right, choose the **Subjects** and **Sessions** that apply (see Step 6).
6. Click **Publish**.

!!! tip "Teacher's tip"
    Fill in **Short Description** for every course. In the catalog list it is what visitors read to decide whether to click.

## Step 5: Link instructors

Courses and people are linked both ways. When you add someone under **Related Personnel** on a course, the course appears under **Related Courses** on that person's profile, and the reverse is also true. You only need to make each connection once, from whichever side is easier.

On the front end, the course page lists its instructors under your **Instructors Label**, and the profile lists the course under **Courses Taught** (Lesson 8 explains how to rename that).

## Step 6: Subjects and sessions

Two groupings are specific to courses:

- **Subject** is the discipline, such as *Nursing* or *Welding*.
- **Session** is when a course runs, such as *Fall*, *Spring* or *Summer*. Many colleges call this a term.

Create them under **Course Catalog > Subjects** and **Course Catalog > Sessions**, then add them in the **Subjects** and **Sessions** boxes on the course screen. These boxes work like WordPress tags: type a name and click **Add**, or pick from the most used. The course page shows its sessions as **Offered in Fall, Spring**. Both drive the **Subject** and **Session** filters on the catalog page. Lesson 9 shows how to rename them.

## Try it yourself

Add the course *Fundamentals of Nursing* (code `NUR101`, 4 credits, subject *Nursing*, sessions *Fall* and *Spring*), taught by *Dr. Maya Okafor*. Riverbend's registration system uses the address `https://register.riverbend.example/search?course=KEY`.

??? success "Check your work"
    1. **Course Catalog > Add New**, title `Fundamentals of Nursing`.
    2. In **Course Info**: **Course Code** `NUR101`, **Credits** `4`, a **Short Description**, and **Related Personnel** *Dr. Maya Okafor*.
    3. Add *Nursing* in the **Subjects** box and *Fall* and *Spring* in the **Sessions** box.
    4. Under **Pedal > Settings > Course Catalog**, set **Registration Search URL** to `https://register.riverbend.example/search?course=KEY`, or set it on this one course.
    5. **Publish**. The page title reads **Fundamentals of Nursing (NUR101)**, shows **4 credits** and **Offered in Fall, Spring**, and has a **Register** button.

## Recap

- **Enable Course Catalog** controls the whole catalog, including `/courses/`.
- The **Configure Course Catalog** group sets the page; **Configure Courses** sets the labels.
- Each course has a **Course Code**, **Credits**, a **Short Description** and **Related Personnel**.
- Course and person links work in both directions.
- **Subject** and **Session** are the two course-only groupings.

**Next lesson:** [Faculty & staff directory](../directory/faculty-staff.md)
