# Welcome to Pedal CMS

Pedal CMS turns a WordPress site into a program marketing site for a college, university, school or training provider. It adds a searchable program finder, a course catalog and a faculty and staff directory, and it keeps them organized with groupings such as colleges, departments and program types.

This guide is a course. We will build a small site together, one lesson at a time, and every lesson ends with an exercise so you can check that you understood the material before moving on. If you have ever wished that a plugin came with a patient teacher, you are in the right place.

## Who this course is for

This course is written for **site administrators and content editors**. You should be comfortable signing in to the WordPress dashboard, adding a post or a page, and uploading an image. You do not need to write code, and none of the lessons ask you to.

If you are a developer who needs hooks, template overrides or the PHP API, skip ahead to the [Developer handbook](developers/index.md). The lessons here deliberately stay on the dashboard side of the fence.

## Requirements

Before we start, make sure your site meets these requirements. They come from the plugin's own header.

| Requirement | Minimum |
|---|---|
| WordPress | 6.9 |
| PHP | 8.2 |

You do not need any other plugin. If you want breadcrumbs on your program pages, Pedal CMS works with Breadcrumb NavXT, Yoast SEO, All in One SEO and Rank Math, and we will cover that in Lesson 3.

## Our running example

Throughout the course we will use a fictional school, **Riverbend Community College**. Riverbend offers programs such as *Nursing (ADN)*, *Welding Technology* and *Business Administration*. It has two colleges, the *College of Health Sciences* and the *College of Trades & Technology*, and it employs people such as *Dr. Maya Okafor*, Professor of Nursing.

Riverbend does not exist. Any resemblance to a real institution is a coincidence, and every URL we use on the course ends in `.example` so it cannot point anywhere real. Follow along with your own institution's names if you prefer; the steps are identical.

## How the course is organized

The course has twelve lessons in six modules. Each lesson takes 10 to 20 minutes. They build on each other, so I recommend taking them in order the first time through.

| Module | Lesson | What you will do |
|---|---|---|
| Getting started | [Lesson 1: Installing Pedal CMS](getting-started/installing.md) | Install, activate and find your way around |
| | [Lesson 2: A tour of the settings](getting-started/settings-tour.md) | Learn what each settings tab is for |
| | [Lesson 3: Look and feel](getting-started/look-and-feel.md) | Choose a presentation mode, colors and breadcrumbs |
| Programs | [Lesson 4: Your first program](programs/first-program.md) | Add a program and set up its buttons and deadlines |
| | [Lesson 5: Program subpages](programs/subpages.md) | Fill in the Curriculum, Cost, Apply and other tabs |
| | [Lesson 6: The program finder](programs/program-finder.md) | Set up the page where visitors browse and search |
| Courses | [Lesson 7: The course catalog](courses/course-catalog.md) | Add courses and connect them to instructors |
| Directory | [Lesson 8: Faculty & staff directory](directory/faculty-staff.md) | Add people and show them on programs and courses |
| Organizing content | [Lesson 9: Taxonomies](organizing/taxonomies.md) | Group and rename colleges, departments and more |
| | [Lesson 10: FAQs](organizing/faqs.md) | Write FAQs once and reuse them |
| Extras | [Lesson 11: Blocks](extras/blocks.md) | Understand the blocks that come with the plugin |
| | [Lesson 12: The terms grid shortcode](extras/terms-grid-shortcode.md) | Show a grid of colleges on any page |

When you get stuck, the [Troubleshooting](help/troubleshooting.md) page lists the problems that come up most often, and the [Glossary](help/glossary.md) explains the vocabulary.

## How to read the callouts

You will see the same few boxes in every lesson. Here is what they mean.

!!! abstract "What you'll learn"
    Appears at the top of each lesson. It lists the goals, the time you need and what to have ready.

!!! tip "Teacher's tip"
    Something I have learned from running this class many times. Optional, but usually worth reading.

!!! warning "Common mistake"
    A trap that catches many students. Read these before you start the step they describe.

Each lesson ends with **Try it yourself**, a short exercise with a collapsible **Check your work** answer. Try the exercise before you open the answer. You learn far more from a wrong attempt than from reading a right one.

## Menu names used in this course

We describe screens with bold labels and `>` signs. For example, **Pedal > Settings** means: click **Pedal** in the left-hand dashboard menu, then click **Settings** in the submenu that opens. Your theme and your other plugins may add menu items of their own, but these names come straight from Pedal CMS.

Ready? Let's begin with [Lesson 1: Installing Pedal CMS](getting-started/installing.md).
