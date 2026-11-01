# Writing the docs

!!! abstract "What you'll learn"
    - How the documentation is laid out in the repository.
    - The voice and structure every lesson follows.
    - How to preview the site and the API reference on your machine.
    - How the generated pages arrive with each release, and a checklist for documenting a new feature.

    **Time:** about 20 minutes · **You'll need:** Python 3, PHP 8.2 and (for the API reference) Docker or a phpDocumentor install

## Why we write this way

People read documentation when they are stuck or new, and either state is easier to bear with a patient guide. Our user guide is therefore written like a hands-on class: an instructor walks the student through, explains why before how, and warns about the mistakes that experience has taught. The developer handbook keeps the same voice for a more technical reader.

## Repository layout

The documentation has its own repository, separate from the plugin, so none of it ships in the plugin zip. The user guide is built with [MkDocs](https://www.mkdocs.org/) and the Material theme.

```text
.github/workflows/reference.yml     Builds the generated pages for each plugin release
.reference-tag                      Plugin tag the generated pages were built from
tools/                              Generators: build-reference.sh, hooks script, phpDocumentor config and template
phpdocs/                            PHP API reference (generated, do not edit)
userguide/
├── mkdocs.yml                      Site settings, theme, nav
├── requirements.txt                Pinned MkDocs and theme versions
└── docs/
    ├── index.md                    Welcome to class
    ├── stylesheets/extra.css       Brand colors
    ├── getting-started/            Lessons 1-3
    ├── programs/                   Lessons 4-6
    ├── courses/                    Lesson 7
    ├── directory/                  Lesson 8
    ├── organizing/                 Lessons 9-10
    ├── extras/                     Lessons 11-12
    ├── help/                       Troubleshooting and glossary
    ├── developers/                 Developer handbook
    │   └── hooks-reference.md      Generated, do not edit
    └── contributing/               This page
```

Two pieces are generated from the plugin source and arrive by pull request: `phpdocs/` and `userguide/docs/developers/hooks-reference.md`. Never edit them by hand; the next release overwrites them. The tools that generate them live in `tools/` here and read a checkout of the plugin; the plugin repository holds no documentation tooling.

## Where the docs are published

The docs are published at <https://pedalcms.com/docs/>. The contents of `userguide/site/` (the output of `mkdocs build --strict`) go to `/docs/`, and `phpdocs/` goes to `/docs/phpdocs/`.

`site_url` in `userguide/mkdocs.yml` must stay `https://pedalcms.com/docs/`. The handbook links to the API reference with the root-relative path `/docs/phpdocs/`, so both paths must move together if the location ever changes. Deployment is not automated yet.

## Style guide

The reader is a student in a hands-on class, and you are the instructor.

- Use second person and an inclusive "we" or "let's". Be warm and patient, never condescending. Avoid "simply", "just" and "obviously".
- Explain the **why** before the **how**. A short real-world analogy is welcome when it genuinely helps, at most one per lesson.
- Anticipate mistakes the way a teacher who has run the class many times would. Use `!!! warning "Common mistake"` for pitfalls and `!!! tip "Teacher's tip"` for shared experience.
- Keep paragraphs to four sentences or fewer. Write procedures as numbered steps, one action per step, and bold the exact UI labels.
- Describe screens with bold labels and `>` paths, such as **Pedal > Settings > Subpages**. Do not add images or image placeholders.
- Write US English. Use no emojis, no marketing adjectives, and at most one exclamation mark per page.
- Use the fictional **Riverbend Community College** for every example: programs such as *Nursing (ADN)*, *Welding Technology* and *Business Administration*, the *College of Health Sciences* and *College of Trades & Technology*, and *Dr. Maya Okafor*, Professor of Nursing.
- Check every menu path, label, default, slug and hook name against the source before you write it. If you cannot verify a claim, leave it out.

## Lesson template

Every lesson ends with an exercise, a recap and a link to the next lesson.

```markdown
# Lesson 4: Your first program

!!! abstract "What you'll learn"
    - ...
    - ...

    **Time:** about 15 minutes · **You'll need:** ...

## Why this matters
...

## Step 1: ...
1. Go to **Programs > Add New**.
2. ...

!!! tip "Teacher's tip"
    ...

## Try it yourself
...

??? success "Check your work"
    ...

## Recap
- ...

**Next lesson:** [Program subpages](subpages.md)
```

Available extensions include admonitions, collapsible blocks (`???`), content tabs (`=== "Classic theme"`), tables, definition lists and keyboard keys. They are listed under `markdown_extensions` in `mkdocs.yml`.

## Previewing locally

Create a virtual environment, install the pinned tools, and start the preview server. Run these from the `userguide/` folder.

```bash
python3 -m venv .venv && . .venv/bin/activate
pip install -r requirements.txt
mkdocs serve
```

Open the address `mkdocs serve` prints and the page reloads as you save.

To see how unreleased plugin changes will look in the generated pages, run the build script from the root of the docs repository, pointing it at a plugin checkout:

```bash
tools/build-reference.sh ../wp-content/plugins/pedalcms      # needs PHP 8.2 and Docker (or a phpdoc binary)
git restore phpdocs userguide/docs/developers/hooks-reference.md .reference-tag   # throw the preview away
```

Treat that output as a preview only. The committed versions come from the release pull request, so run the `git restore` line when you are done.

Before you push, run a strict build. It turns warnings, such as broken internal links, into errors.

```bash
mkdocs build --strict
```

## How the generated pages are updated

The generated pages follow plugin releases.

1. Once a day, the **Reference docs** workflow (`.github/workflows/reference.yml`) in this repository looks up the latest Pedal CMS release. You can also start it yourself from **Actions > Reference docs > Run workflow**.
2. If that release is not built yet, the workflow checks out the plugin at its tag, generates the hooks reference, and builds the PHP API reference with phpDocumentor.
3. The workflow zips the API reference and attaches it to the plugin's GitHub Release as `pedalcms-api-docs-<tag>.zip`, replacing any earlier zip with that name. This step is skipped when the `PLUGIN_RELEASE_TOKEN` secret is not set, and a failed upload only logs a warning.
4. The workflow opens a pull request against this repository on a branch named `phpdocs/<tag>`. It replaces `phpdocs/` in full, updates `userguide/docs/developers/hooks-reference.md` and records the tag in `.reference-tag`.
5. A maintainer reviews and merges it. The hooks reference diff is the quickest way to spot new or changed hooks that the handbook should mention.

Only the latest full release is picked up automatically, so prereleases are skipped. To build a specific tag, such as an older release or a prerelease, run the workflow by hand and enter the tag, for example `v0.7.0`. Running it again for the same tag updates the open pull request instead of opening a second one.

This repository needs a few settings, made once:

- Under **Settings > Actions > General > Workflow permissions**, enable **Allow GitHub Actions to create and approve pull requests**.
- Optionally, a variable named `PLUGIN_REPOSITORY` under **Settings > Secrets and variables > Actions**, holding the plugin repository as `owner/name`. It defaults to `PedalCMS/pedalcms`.
- Only while the plugin repository is private, a secret named `PLUGIN_REPO_TOKEN` holding a fine-grained token with **Contents** set to read on that repository.
- Optionally, a secret named `PLUGIN_RELEASE_TOKEN` holding a fine-grained token with **Contents** set to read and write on the plugin repository. It is used only to upload the zip; without it the zip step is skipped. The same token can also be stored as `PLUGIN_REPO_TOKEN` if the plugin repository is private.

Pull requests opened by the workflow do not start other workflows, because they use the built-in token.

## Checklist: documenting a new feature

1. Add or update the lesson in the user guide, using the lesson template. Add new pages to `nav` in `userguide/mkdocs.yml`.
2. Add the feature's terms to the glossary and a Q&A to troubleshooting if a common mistake is likely.
3. Write docblocks for every new public class, method and function in the plugin: summary, `@since`, `@param` and `@return`.
4. Put a docblock above every new `do_action()` and `apply_filters()` call. The hooks reference picks it up at the next release.
5. If the feature changes templates, update [Template overrides](../developers/template-overrides.md).
6. Verify every label, path and default against the source.
7. Run `mkdocs build --strict` and fix every warning.
8. Update the changelog in the plugin's `readme.txt`.

## Recap

- The docs live in their own repository: the user guide in `userguide/`, the PHP API reference in `phpdocs/`.
- Write like an instructor: why before how, warn about common mistakes, end with an exercise.
- Preview with `mkdocs serve`, check with `mkdocs build --strict`.
- A daily check in this repository opens a pull request with fresh generated pages after each plugin release; review and merge it. The same run attaches a zip of the API reference to the release.
- The docs are published at `https://pedalcms.com/docs/`, with the API reference at `/docs/phpdocs/`.
- Preview generated pages with `tools/build-reference.sh`, then `git restore` them.
