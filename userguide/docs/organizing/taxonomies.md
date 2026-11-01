# Lesson 9: Taxonomies

!!! abstract "What you'll learn"
    - What a taxonomy is, in plain language
    - What each of Pedal CMS's groupings is for
    - What **Enable**, **Enable Archive**, **Singular Label**, **Plural Label** and **Use With** do
    - How departments can depend on colleges
    - How to rename a grouping, for example "College" to "School"

    **Time:** about 20 minutes · **You'll need:** access to **Pedal > Settings**

## Why this matters

Imagine a filing cabinet with hundreds of folders and no labels. You could find anything, eventually, by opening every folder. Now imagine each folder has a colored tab: *Health Sciences*, *Trades & Technology*. Suddenly you can find things, and you can also ask questions such as "show me every folder with a blue tab."

A **taxonomy** is a set of those labels, and each individual label is a **term**. WordPress itself has two taxonomies you already know: categories and tags. Pedal CMS adds seven of its own, so that visitors can filter programs, courses and people, and so that you can show a program's college or type on its page.

## Step 1: Meet the groupings

| Grouping | Used for | Where it appears in the dashboard |
|---|---|---|
| **College** | Programs, courses, people | Under **Pedal**, **Course Catalog** and **Directory** menus |
| **Department** | Programs, courses, people | Same menus as College |
| **Program Type** | Programs, for example *Certificate* or *Associate Degree* | Under **Pedal** |
| **Instruction Mode** | Programs, for example *In-person*, *Online*, *Hybrid* | Under **Pedal** |
| **Subject** | Courses | Under **Course Catalog** |
| **Session** | Courses, for example *Fall*, *Spring* (often called a term) | Under **Course Catalog** |
| **Personnel Category** | People, for example *Faculty* or *Staff* | Under **Directory** |

There is also **FAQ Category** for organizing FAQs, which Lesson 10 covers.

To add terms, open the grouping's menu item (for example **Pedal > Colleges**), type a name and click the add button. Create *College of Health Sciences* and *College of Trades & Technology* now.

## Step 2: Open the Taxonomies tab

Go to **Pedal > Settings** and open the **Taxonomies** tab. Each grouping has its own block of settings. Here is what the settings mean.

| Setting | What it does |
|---|---|
| **Enable** | Switches the grouping on or off. It is on by default. FAQ Category has no switch. |
| **Enable Archive** | Whether the grouping's terms get their own pages. See Step 3. |
| **Singular Label** | The name for one term's type, such as `College`. Leave empty for the default. |
| **Plural Label** | The name for many, such as `Colleges`. Leave empty for the default. |
| **Use With** | Which content types the grouping applies to. See Step 5. |

Not every grouping has every setting.

| Grouping | Enable | Enable Archive | Labels | Other |
|---|---|---|---|---|
| **College** | Yes | Yes | Yes | **Use With** |
| **Department** | Yes | Yes | Yes | **Depends on College**, **Use With** |
| **Program Type** | Yes | Yes | Yes | |
| **Instruction Mode** | Yes | No | Yes | |
| **Subject** | Yes | No | Yes | |
| **Session** | Yes | No | Yes | |
| **Personnel Category** | Yes | Yes | Yes | |
| **FAQ Category** | No | No | Yes | |

!!! warning "Common mistake"
    Switching a grouping off hides it from the dashboard menus, the search filters and the front-end pages, but it does not delete your terms. Switch it back on and they return. Remember to re-check **Search Filters** on the **Programs**, **Course Catalog** and **Directory** tabs afterward.

## Step 3: Archives, and what happens when they are off

An **archive** is a page that lists everything that has a given term. Visitors reach it by clicking, say, the college name on a program page. College, Program Type and Personnel Category get tidy archive pages at addresses such as:

| Grouping | Example address |
|---|---|
| **College** | `https://riverbend.example/college/college-of-health-sciences/` |
| **Program Type** | `https://riverbend.example/program-type/certificate/` |
| **Personnel Category** | `https://riverbend.example/personnel-category/faculty/` |

When **Enable Archive** is switched off, those pages do not exist. Instead, links to the term lead to the matching **filtered** list. The college link on a program page takes the visitor to the program finder, already filtered to that college. The help text says the same: "If disabled, links will point to a filtered programs view." For Personnel Category it is "a filtered directory view."

Archives are the nicer experience, because each term gets its own page, heading and image. Turn **Enable Archive** off only if you would rather keep visitors inside the finder or the directory.

Department, Instruction Mode, Subject and Session have no tidy pages of their own. Their links go to filtered lists. Department shows an **Enable Archive** switch for consistency, but in version 0.6.7 its links lead to a filtered list either way.

## Step 4: Depends on College

On a large campus, a department belongs to one college. *Nursing* belongs to *Health Sciences*, not to *Trades & Technology*. The **Depends on College** switch, on by default, tells Pedal CMS to enforce that.

When it is on:

1. Each department you create has a **College** field. Set it.
2. On a program or a person, the **Department** list shows only the departments belonging to the college you chose. If the college has none, the list says **No departments found**.

So choose the college first, then the department.

The **Enable** switch for Department also controls the other two. Switching Department off hides its **Enable Archive** and **Depends on College** options.

!!! tip "Teacher's tip"
    If your institution does not have colleges, switch **College** off. If your colleges and departments are independent, switch **Depends on College** off. Do not leave a grouping on out of habit; every filter you show is one more thing for visitors to figure out.

## Step 5: Use With

College and Department can apply to more than one content type. **Use With** has a switch for each: **Programs**, **Course Catalog** and **Faculty & Staff Directory**. All three are on by default.

If Riverbend wants colleges on programs and people but not on courses, switch **Course Catalog** off under **Use With** for College.

## Step 6: Rename a grouping

Some institutions say "School" instead of "College" and "Term" instead of "Session". You can rename any grouping:

1. On the **Taxonomies** tab, find the **College** block.
2. In **Singular Label**, type `School`.
3. In **Plural Label**, type `Schools`.
4. Click **Save Changes**.

Menus, filters and the college line on program pages now say **School**. The web address does not change: archive pages stay at `/college/...`, so existing links keep working.

Fill in both labels. If you set only one, the other keeps its default and you will see a mixture of "School" and "Colleges".

A few places inside the settings screen itself, such as the **Search Filters** switches, may keep the original name.

## Step 7: Term images and extra fields

When you edit a term, Pedal CMS adds extra fields:

| Grouping | Extra fields |
|---|---|
| **College** | **Featured Image**, **Header Background** |
| **Department** | **College**, **Featured Image**, **Header Background** |
| **Program Type** | **Featured Image**, **Header Background**, **Application Deadlines** |
| **Personnel Category** | **Featured Image**, **Header Background** |

The featured image shows on the term's archive page and in a terms grid (Lesson 12). The header background only shows in **Tuxedo** presentation mode. A term's **Description** appears in a terms grid as well.

## Try it yourself

Riverbend wants "College" to read "School" everywhere, wants department choices limited to the chosen school, and wants *Instruction Mode* terms *In-person*, *Online* and *Hybrid*.

??? success "Check your work"
    1. **Pedal > Settings > Taxonomies**, **College** block: **Singular Label** `School`, **Plural Label** `Schools`.
    2. In the **Department** block, leave **Depends on College** on. When you add departments under **Pedal > Departments**, set each one's **College** (now **School**).
    3. Add the three terms under **Pedal > Instruction Modes**.
    4. **Save Changes**, then edit a program and check that the **Department** list follows the chosen school.

## Recap

- A taxonomy is a set of labels (terms) that group content.
- Pedal CMS has seven groupings, plus FAQ Category.
- **Enable** turns a grouping on or off; **Enable Archive** gives terms their own pages, or sends links to a filtered list.
- **Depends on College** limits department choices to the chosen college.
- **Singular Label** and **Plural Label** rename a grouping without changing web addresses.
- **Use With** chooses whether College and Department apply to programs, courses and people.

**Next lesson:** [FAQs](faqs.md)
