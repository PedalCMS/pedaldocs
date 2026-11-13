# Program subpages

!!! abstract "In this guide"
    - What subpages are and how visitors move between them
    - How to turn subpages on or off for the whole site and for a single program
    - How to rename a subpage's title and tab label
    - What each built-in subpage shows, and where you edit its content

    **Time:** about 20 minutes · **You'll need:** the *Nursing (ADN)* program from Lesson 4

## Background

Subpages are central to Pedal's methodology. They turn every program into a microsite, giving prospective students a complete view of the program from basic information to the team that they will work with and even how much they can expect to pay for it. No hunting all over the site and potentially getting lost or distracted. This proven strategy was why we built Pedal. 

Every program automatically gets a row of tabs (Subpages), and each tab is its own page with its own address, but all of them belong to the same program. And you edit everything on one program screen. Easy to use, easy to manage. 

## Meet the subpages

Pedal CMS includes eight views of a program. The first is the program's main page; the other seven are subpages you can switch on or off.

| Tab (default label) | Address ending | What it shows |
|---|---|---|
| **Overview** | (the program's own address) | The **Overview Content** from the **Main** tab |
| **Curriculum** | `/curriculum/` | Sections of courses |
| **Careers** | `/careers/` | Careers related to the program |
| **Faculty & Staff** | `/faculty-staff/` | People who teach or support the program |
| **Cost** | `/cost/` | An estimated cost and cost details |
| **How to Apply** | `/apply/` | Application instructions |
| **FAQs** | `/faqs/` | Questions and answers |
| **News** | `/news/` | News posts tagged for the program |

The addresses are built from the program's address. For *Nursing (ADN)*, the curriculum page is `https://riverbend.example/program/nursing-adn/curriculum/`. The row of tabs appears in the program header.

!!! note "Note"
    It is possible to create your own subpages, but this requires the help of a developer. See [`pedalcms_register_program_subpage` in the phpDocs](https://pedalcms.com/docs/phpdocs/namespaces/default.html#function_pedalcms_register_program_subpage) 

## Turn subpages on or off site-wide

1. Go to **Pedal > Settings** and open the **Subpages** tab.
2. Find **Enabled Program Subpages**.
3. Switch each subpage on or off: **Curriculum**, **Careers**, **Faculty & Staff**, **Cost**, **How to Apply**, **FAQs**, **News**.
4. Click **Save Changes**.

All seven are on by default. A subpage you switch off disappears from every program, and its address stops working.

!!! warning "Important"
    Turning **FAQs** off also removes the **FAQs** item from the dashboard menu, because the FAQ content type only exists while the FAQs subpage is enabled. Your existing FAQs are not deleted; switch the subpage back on and they return.

## Hide a subpage on one program

The site-wide switch is a blunt tool. Sometimes only one program needs a tab hidden. *Business Administration* might have no news, for example.

1. Open the program, and click its tab in the **Program Info** box (for example **News**).
2. Switch off the first item on the tab: **Show News Section**.
3. Click **Update**.

Each tab has one: **Show Curriculum Section**, **Show Careers Section**, **Show Faculty & Staff Section**, **Show Cost Section**, **Show Apply Section**, **Show FAQs Section** and **Show News Section**. They are all on by default for a new program. When one is off, that program's tab row skips it.

The site-wide setting always wins. A subpage that is off on the **Subpages** tab cannot be turned on for one program.

!!! warning "Common issue"
    A tab that is missing on a single program usually means one of those **Show ... Section** switches is off, or the program was created by an import or script and never saved in the editor. Open the program, check the switch, and click **Update** once.

## Rename a subpage

Every subpage has two names, and both are on the **Subpages** tab.

- **Page Title** is the heading at the top of the subpage.
- **Tab Label** is the text on the tab.

Leave them empty to use the defaults. The gray placeholder shows the default, for example **How to Apply**. An institution might prefer short tabs and friendly headings, like this:

| Group | Tab Label | Page Title |
|---|---|---|
| **Curriculum** | `Courses` | `What You'll Study` |
| **Cost** | `Tuition` | `Tuition and Fees` |

The **Overview** tab is not configurable here but it is possible for a developer to change it.

## Fill in each subpage

Each subpage has a tab in the **Program Info** box on the program edit screen. Most have a **Lead** field, which is text shown at the top of the subpage before the main content. For some subpages, this may be all the content that you want to appear. That's fine. 

### Curriculum

- **Show Curriculum Section**: the on/off switch described above.
- **Curriculum Lead**: an introduction shown first.
- **Curriculum Sections**: click **Add Section**. Each section has a **Section Title** (for example *Core nursing courses*), **Section Content** (a note such as "Choose two of the following") and **Section Courses**, where you pick courses from your Course Catalog.

On the **Subpages** tab, the **Curriculum** group has **Show Credits**. When on (the default), course tables on the curriculum page include a credits column. Courses come from the [Course Catalog](courses/course-catalog.md), so keep the catalog enabled if you use curriculum sections.

### Careers

- **Careers Lead** and **Related Careers**.

The **Subpages** tab in the settings has a **Career Post Type** setting. Careers are a separate content type that Pedal CMS does not register itself. The setting allows you to choose a post type that you or another plugin has created. When set, you will be able to choose from careers to associate with a program which will show up in a linked list below the lead text. 

Without a careers post type, the **Related Careers** list has nothing to choose from, and the **Careers** tab can show only its lead text. If you do not want careers content, switch the subpage off.

### Faculty & Staff

- **Faculty & Staff Lead**.
- **Group by Category** (on by default): when on, people are listed under headings such as *Faculty* and *Staff*, using their personnel category.
- **Related Faculty & Staff**: pick people from your [directory](directory/faculty-staff.md).

### Cost

- **Estimated Cost Label**: the heading for the estimate. Leave empty for **Estimated Cost**.
- **Estimated Cost**: a short text such as `$4,800 per year`. Leave it empty to hide the estimate box.
- **Cost Content**: the detailed text, such as tuition, fees and books.

### Apply

- **Apply Content**: the instructions for applying. There is no lead field; the whole subpage is this one box.

### FAQs

- **Group FAQs by Category** (on by default), **FAQs Lead** and an **FAQ List**.  See [FAQs](organizing/faqs.md) for more details.

### News

- **News Tag**: a post tag. The subpage lists your blog posts that carry this tag.
- **Number of News Posts**: how many to show. The default is 10, and `-1` shows all of them.
- **Show "All News" Link**: adds a link to the full archive of posts tagged with `News Tag` page at the bottom.
- **Featured News Posts**: posts to keep at the top of the list. They will be removed from the list below.
- **News Lead**: an optional introduction.

!!! tip "Tip"
    For news, create one tag per program, such as `nursing-news`, and tag your announcements with it. After that, the News tab maintains itself and content editors simply tag their posts with the program tag. 

**Next up:** [The program search](program-search.md)
