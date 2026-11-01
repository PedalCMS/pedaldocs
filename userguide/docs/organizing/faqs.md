# Lesson 10: FAQs

!!! abstract "What you'll learn"
    - What FAQs and FAQ categories are in Pedal CMS
    - How to write a global FAQ once and reuse it on many programs
    - How to add a program-specific FAQ
    - How the FAQs subpage groups its questions

    **Time:** about 15 minutes · **You'll need:** the **FAQs** subpage switched on under **Pedal > Settings > Subpages** (it is on by default)

## Why this matters

Some questions come up for every program: "Is financial aid available?" or "Can I transfer credits?" Other questions belong to one program only: "Does the nursing program require a background check?"

If you copy the global questions onto forty program pages, you will have forty places to update when the financial aid office changes its hours. Pedal CMS avoids that. You write a shared question once, in a library of FAQs, and pick it on any program that needs it. You can also write a question directly on one program when it is unique to that program.

## Step 1: Check that FAQs are available

The **FAQs** menu in the dashboard exists only while the **FAQs** subpage is enabled. If you cannot see it, go to **Pedal > Settings > Subpages**, switch **FAQs** on under **Enabled Program Subpages**, and save.

## Step 2: Create FAQ categories (optional)

FAQ categories let you group questions under headings such as *Admissions*, *Financial Aid* and *Student Life*.

1. Go to **FAQs > FAQ Categories**.
2. Enter a name and click the add button.

Categories are hierarchical, like WordPress's post categories. You can rename the grouping on the **Taxonomies** tab (**FAQ Category** block, **Singular Label** and **Plural Label**), although it has no **Enable** switch.

## Step 3: Write a global FAQ

1. Go to **FAQs > Add New**.
2. In the title box, which says **Enter the Question**, type the question: `Is financial aid available?`
3. In the main editor, write the answer.
4. Choose a category in the **FAQ Categories** box, if you use them.
5. Click **Publish**.

The title is the question and the body is the answer.

## Step 4: Attach FAQs to a program

1. Edit a program, for example *Nursing (ADN)*, and open the **FAQs** tab in **Program Info**.
2. Make sure **Show FAQs Section** is on.
3. Click **Add FAQ** to add a row in the **FAQ List**.
4. Choose a **FAQ Type** for that row: **Global FAQ** or **Local FAQ**.
5. Fill in the fields that match the type, as shown below.
6. Click **Update**.

| FAQ Type | Fill in | Ignored |
|---|---|---|
| **Global FAQ** | **FAQ Post**, the question you wrote in Step 3 | **Question**, **Answer**, **FAQ Category** |
| **Local FAQ** | **Question** and **Answer** for this program. Optionally choose a **FAQ Category** | **FAQ Post** |

The form shows all the fields at once. The program uses only the ones that belong to the type you chose.

A global FAQ takes its category from the FAQ itself. A local FAQ takes the category you choose in the row.

Other settings on the tab:

- **FAQs Lead**: introductory text shown above the list.
- **Group FAQs by Category** (on by default): see Step 5.

!!! warning "Common mistake"
    Choosing **Global FAQ** and then typing a **Question** and **Answer** in the same row. Those boxes are ignored for global FAQs; the program shows the text from the FAQ post instead. If your wording does not appear, check the row's type.

## Step 5: How the FAQs subpage looks

The program's **FAQs** page (for example `/program/nursing-adn/faqs/`) shows each question as an expandable item. Visitors click the question to reveal the answer.

With **Group FAQs by Category** on, questions appear under a heading for each category. Questions with no category are collected under **Uncategorized**. With it off, the questions appear in one list in the order you added them.

!!! tip "Teacher's tip"
    Give every FAQ a category if you group them. A single **Uncategorized** heading in the middle of a tidy list looks accidental.

## Try it yourself

Write a global FAQ called *Is financial aid available?* in a category named *Financial Aid*, and use it on *Nursing (ADN)*. Add a local question to the same program: *Does the program require a background check?* with a short answer.

??? success "Check your work"
    1. **FAQs > FAQ Categories**: add `Financial Aid`.
    2. **FAQs > Add New**: title `Is financial aid available?`, an answer in the editor, category *Financial Aid*, **Publish**.
    3. Edit *Nursing (ADN)*, **FAQs** tab, **Add FAQ**: **FAQ Type** **Global FAQ**, **FAQ Post** set to the FAQ you just wrote.
    4. **Add FAQ** again: **FAQ Type** **Local FAQ**, **Question** `Does the program require a background check?`, a short **Answer**. Leave **FAQ Category** empty or choose one.
    5. **Update**, then open `/program/nursing-adn/faqs/`. If grouping is on, the local question appears under **Uncategorized** unless you gave it a category.

## Recap

- FAQs are a library: the title is the question, the body is the answer.
- The **FAQs** menu exists only while the **FAQs** subpage is enabled.
- On a program, each **FAQ List** row is either a **Global FAQ** (pick an FAQ post) or a **Local FAQ** (type the question and answer).
- **Group FAQs by Category** groups questions under headings, with leftovers under **Uncategorized**.

**Next lesson:** [Blocks](../extras/blocks.md)
