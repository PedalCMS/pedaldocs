# FAQs

!!! abstract "In this guide"
    - What FAQs and FAQ categories are in Pedal
    - How to write a global FAQ once and reuse it on many programs
    - How to add a program-specific FAQ
    - How the FAQs subpage groups its questions

    **Time:** about 15 minutes · **You'll need:** the **FAQs** subpage switched on under **Pedal > Settings > Subpages** (it is on by default)

## Background

Some questions come up for every program: "Is financial aid available?" or "Can I transfer credits?" Other questions belong to one program only: "Does the nursing program require a background check?"

If you copy the global questions onto forty program pages, you will have forty places to update when the financial aid office changes its hours. Pedal avoids that. You write a shared question once, in a library of FAQs, and pick it on any program that needs it. You write a question directly on a program when it is unique to that program.

## Check that FAQs are available

The **FAQs** menu in the dashboard exists only while the **FAQs** subpage is enabled. If you cannot see it, go to **Pedal > Settings > Subpages**, switch **FAQs** on under **Enabled Program Subpages**, and save.

## Create FAQ categories (optional)

FAQ categories let you group questions under headings such as *Admissions*, *Financial Aid* and *Student Life*.

1. Go to **FAQs > FAQ Categories**.
2. Enter a name and click the add button.

Categories are hierarchical, like WordPress's post categories. You can rename the grouping on the **Taxonomies** tab (**FAQ Category** block, **Singular Label** and **Plural Label**), although it has no **Enable** switch.

## Writing a global FAQ

1. Go to **FAQs > Add New**.
2. In the title box, which says **Enter the Question**, type the question (e.g. `Is financial aid available?`)
3. In the main editor, write the answer.
4. Choose a category in the **FAQ Categories** box, if you use them.
5. Click **Publish**.

Simply put, the title is the question and the body is the answer.

## Attaching FAQs to a program

1. Edit a program, for example *Nursing (ADN)*, and open the **FAQs** tab in **Program Info**.
2. Make sure **Show FAQs Section** is on.
3. Click **Add FAQ** to add a row in the **FAQ List**.
4. Choose a **FAQ Type** for that row: **Global FAQ** or **Local FAQ**.
5. Fill in the fields that match the type, as shown below.
6. Click **Update**.

| FAQ Type | Fill in | Ignored |
|---|---|---|
| **Global FAQ** | **FAQ Post** | **Question**, **Answer**, **FAQ Category** |
| **Local FAQ** | **Question** and **Answer** for this program. Optionally, choose a **FAQ Category** | **FAQ Post** |

!!! warning "Bug"
    Due to a bug ([issue 219](https://github.com/PedalCMS/pedalcms/issues/219)), the form currently shows all the fields at once. The program uses only the ones that belong to the type you chose (Global vs. Local). A global FAQ takes its category from the FAQ itself. A local FAQ takes the category you choose in the row.

Other settings on the tab:

- **FAQs Lead**: introductory text shown above the list.
- **Group FAQs by Category** (on by default): see Step 5.

## The FAQs subpage

The program's **FAQs** page (for example `/program/nursing-adn/faqs/`) shows each question as an expandable item. Visitors click the question to reveal the answer.

With **Group FAQs by Category** on, questions appear under a heading for each category. Questions with no category are collected under **Uncategorized**. With it off, the questions appear in one list in the order you added them.

!!! tip "Tip"
    Give every FAQ a category if you group them. Otherwise, an **Uncategorized** heading will appear in the list and may seem accidental to visitors.

**Next up:** [The terms grid shortcode](../extras/terms-grid-shortcode.md)
