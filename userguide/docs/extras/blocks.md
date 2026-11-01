# Lesson 11: Blocks

!!! abstract "What you'll learn"
    - What the three blocks that come with Pedal CMS do
    - When the **Job Title** and **Contact Info** blocks are available
    - What the **PedalCMS Template** block is for, and why you should leave it alone

    **Time:** about 10 minutes · **You'll need:** nothing special; this lesson is mostly explanation, and a block theme helps if you want to look at the template block

## Why this matters

Blocks are the building pieces of the WordPress editor: a paragraph is a block, an image is a block. Pedal CMS adds three of its own. Two of them help edit a person's details. The third works behind the scenes and quietly holds your program, course and directory pages together.

You will meet these blocks sooner or later, usually when something looks unfamiliar in an editor. Knowing what they are saves you from deleting one by mistake.

## The three blocks at a glance

| Block | Category in the inserter | What it is for |
|---|---|---|
| **Job Title** | Text | Edit a person's job title inside the block editor |
| **Contact Info** | Text | Edit a person's office phone, email address and office |
| **PedalCMS Template** | Theme | Display Pedal CMS's pages inside a block theme's templates |

## Job Title and Contact Info

These two blocks belong to people in the faculty and staff directory.

- **Job Title** shows a single box labeled **Job Title**. What you type is saved as the person's job title, the same value as the **Job Title** field in **Person Info** (Lesson 8).
- **Contact Info** shows three boxes: **Office Phone**, **Email Address** and **Office**. They save the same values as the matching **Person Info** fields.

On the public profile you see the finished result: the job title as a line under the name, and the contact details with their labels.

When a new person is created in the block editor, Pedal CMS starts them with a ready-made layout: two columns. The left, wider column has the **Job Title** block and a paragraph that says **Add some bio text** as a placeholder. The right, narrower column has the person's featured image and the **Contact Info** block.

### When are these blocks available?

Only when personnel are edited with the block editor, and that is not the default. On a standard installation, people are edited with the classic editor, where the **Person Info** box holds the same fields. The two blocks are not even registered in that case. There is currently no switch for this on the **Pedal CMS Settings** page; a developer turns it on. If you do not see these blocks and your people editor looks like the one in Lesson 8, that is expected.

Both blocks read and write information about the person being edited. They are meant for the **Personnel** editor, not for pages or posts.

!!! tip "Teacher's tip"
    Whichever editor you use, the stored information is the same. You can change the editor later without losing anyone's job title or phone number.

## The PedalCMS Template block

This one is different: you do not add it yourself. It does not even appear in the block inserter.

Block themes build every page from templates made of blocks. For Pedal CMS to appear in such a theme, it registers templates for its pages, with titles such as **Single Program**, **Archive Program**, **Single Course**, **Archive Course**, **Single Person** and **Archive Person**, plus taxonomy templates. Each one has three parts: your theme's header, one **PedalCMS Template** block, and your theme's footer. The **PedalCMS Template** block is what draws the program, course or directory page, using the same layout you have seen throughout this course.

In the Site Editor you will see the block as a placeholder box that reads, for example, *The "single-program" template is rendered here on the front end.* The real content cannot be previewed there, so a placeholder is shown instead.

You can see the templates in the Site Editor: go to **Appearance > Editor**, then **Templates**. You may want to edit them to change the header or footer, or to add a banner above the Pedal CMS content.

!!! warning "Common mistake"
    Do not delete the **PedalCMS Template** block from one of these templates. Without it, the page still has a header and footer but the program, course or directory content disappears. You can add other blocks above or below it, but each template may contain only one **PedalCMS Template** block.

On a classic theme, none of this applies. The plugin hooks into your classic theme's templates directly and there is no template block to manage.

## Try it yourself

Answer these three questions.

1. You open the person editor for Dr. Okafor and see a **Person Info** box but no **Job Title** block. Is something broken?
2. A colleague says the **Single Program** page in the Site Editor "looks empty" and wants to delete the odd gray box. What do you tell them?
3. Where do you change a person's office phone number, whichever editor you use?

??? success "Check your work"
    1. No. The blocks are available only when personnel use the block editor. The **Person Info** box holds the same fields in the classic editor.
    2. Leave it. The gray box is the **PedalCMS Template** block, a placeholder for the real program page. Deleting it removes the program content from the front end.
    3. In the **Office Phone** field of **Person Info**, or in the **Contact Info** block if your site uses the block editor for personnel. Both save the same value.

## Recap

- Pedal CMS has three blocks: **Job Title**, **Contact Info** and **PedalCMS Template**.
- **Job Title** and **Contact Info** edit the same data as **Person Info**, and exist only when personnel use the block editor.
- **PedalCMS Template** is used by block themes, is not in the inserter, and holds your Pedal CMS pages in place.
- Never delete **PedalCMS Template** from a Pedal CMS template.

**Next lesson:** [The terms grid shortcode](terms-grid-shortcode.md)
