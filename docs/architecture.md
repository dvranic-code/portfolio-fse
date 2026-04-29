# portfolio-fse — Theme Architecture

Technical blueprint for the theme. This is the contract between Dejan and
Claude Code: every implementation decision is documented here so the build
can stay on schedule.

Visual reference: `../../../../../console-home.html` (project root).
Persona reference: `../../../../../persona.md` (project root).

---

## 1. Theme Metadata

| Field         | Value                                                |
| ------------- | ---------------------------------------------------- |
| Theme name    | Portfolio FSE                                        |
| Text domain   | `portfolio-fse`                                      |
| Slug (folder) | `portfolio-fse`                                      |
| Version       | `1.0.0`                                              |
| Requires WP   | 6.6+                                                 |
| Requires PHP  | 8.0+                                                 |
| License       | MIT                                                  |
| Author        | Dejan Rudić Vranić                                   |
| Tags          | block-theme, full-site-editing, portfolio, dark-mode |

---

## 2. File Structure (target)

portfolio-fse/
├── style.css # theme header + minimal custom CSS (< 50 lines)
├── theme.json # design system: colors, typography, spacing, layout
├── functions.php # pattern category + CPT + taxonomy registration
├── README.md # public-facing repo readme (final task)
├── screenshot.png # 1200×900 theme screenshot
├── claude.md # theme rules + design log
├── docs/
│ └── architecture.md # this file
├── templates/
│ ├── index.html # homepage
│ ├── archive-portfolio.html # Portfolio CPT archive (/projects/)
│ ├── single-portfolio.html # Single Portfolio project
│ ├── archive.html # generic archive fallback (tags, dates)
│ ├── single.html # generic single post fallback
│ ├── page.html # generic page
│ ├── 404.html # terminal-style 404
│ └── search.html # search results
├── parts/
│ ├── header.html
│ └── footer.html
├── patterns/
│ ├── hero.php
│ ├── marquee.php
│ ├── about-section.php
│ ├── work-list.php
│ ├── toolbox.php
│ ├── writing-grid.php
│ ├── community-events.php
│ ├── cta-section.php
│ └── project-card.php # used inside Query Loop
└── assets/
└── fonts/ # self-hosted Inter + JetBrains Mono

---

## 3. Architectural Principles.

### 3.1 PHP → FSE Mental Model (the workshop's core teaching)

| Classic PHP                             | FSE Equivalent                 | Lives in                 |
| --------------------------------------- | ------------------------------ | ------------------------ |
| `wp_enqueue_style()` in `functions.php` | Design tokens in `theme.json`  | `theme.json`             |
| `header.php`                            | Template part                  | `parts/header.html`      |
| `footer.php`                            | Template part                  | `parts/footer.html`      |
| `WP_Query` + `while (have_posts())`     | Query Loop block               | `templates/archive.html` |
| `get_template_part('hero')`             | Synced or unsynced Pattern     | `patterns/hero.php`      |
| `page.php`, `single.php`, etc.          | Block templates (HTML)         | `templates/*.html`       |
| `register_post_type()` for Projects     | `portfolio` CPT + `technology` | `functions.php`          |
|                                         | taxonomy                       |                          |
| Conditional CSS (`is_front_page`)       | Block-level style variations   | block markup             |

### 3.2 Custom Post Type for Projects

Projects use a dedicated `portfolio` Custom Post Type with a `technology`
custom taxonomy. Both registered in `functions.php` on the `init` hook,
both with `show_in_rest => true`. Rationale:

- **Real-world fit.** Agencies and freelancers ship CPTs on every project
  — services, projects, team, testimonials. Filtering Posts by category
  is the toy version of what the audience actually builds at work.
- **Better Query Loop teaching (Task 5).** Demonstrating Query Loop with
  a real CPT — the most common production scenario — beats demonstrating
  it with a category filter on Posts.
- **`show_in_rest => true` is critical.** Without it, the Block Editor
  falls back to classic editor and the Query Loop block cannot query
  the CPT. This is the #1 gotcha for PHP devs migrating from classic
  themes — explicit teaching moment in Task 5.
- **Permalinks must be flushed** (Settings → Permalinks → Save Changes)
  after first activation, otherwise `/projects/` returns 404. Standard
  CPT gotcha.

### 3.3 No Build Step, FSE-Native Styling

Theme ships as plain PHP/HTML/CSS/JSON. **No npm, no Tailwind, no SCSS, no
PostCSS, no Vite.** Rationale:

- **Workshop teaches FSE.** A utility-class framework like Tailwind
  contradicts the core teaching that `theme.json` is the design system.
  60% of the audience are experienced devs — they will spot the contradiction
  and lose trust.
- **Create Block Theme plugin compatibility.** "Save Changes to Theme" pushes
  Site Editor edits back into `theme.json` and template HTML. A build step
  that scans source files cannot see classes added via the editor UI. The
  workshop's headline feature would silently break.
- **Attendee debuggability.** No 75-minute workshop survives a stale build
  cache, a broken watcher, or a missing `node_modules`.

The styling system uses only WordPress-native primitives:

| Need                                         | FSE-native answer                         |
| -------------------------------------------- | ----------------------------------------- |
| Reusable spacing tokens                      | `spacingScale` in `theme.json`            |
| Responsive font sizes                        | Fluid `clamp()` values in `theme.json`    |
| Padding / margin / border controls in editor | `appearanceTools: true`                   |
| Reusable component looks                     | Block style variations                    |
| One-off animations / pseudo-elements         | `style.css` at theme root (auto-enqueued) |
| Inline global CSS                            | `theme.json` → `styles.css` field         |

**Visual target: ~70–80% match to `console-home.html`.** Pixel-perfect
parity is explicitly out of scope. `console-home.html` is a _guide_, not a
_spec_.

### 3.4 Patterns Over Reusable Blocks

Default to **unsynced patterns** (PHP-registered, server-rendered). Synced
blocks are reserved for content the user genuinely wants to update site-wide
(none in the workshop scope).

### 3.5 Locking is Layered

Three governance layers, applied in `05-governance` branch:

1. **Template-level** — `templateLock: "all"` on header/footer parts
2. **Pattern-level** — `lock: { move: true, remove: true }` on the project
   card layout inside the Query Loop
3. **Content-only mode** — applied to the homepage hero so editors can
   update copy but not break layout

---

## 4. `theme.json` Configuration

### 4.1 Color Palette

Mapped from `console-home.html` CSS variables. Slugs are semantic, not
visual — so the theme is renamable without rewriting markup.

| Slug                | Hex       | Used for                               |
| ------------------- | --------- | -------------------------------------- |
| `background`        | `#0a0a0f` | Dark hero, footer, CTA                 |
| `background-alt`    | `#10101a` | Footer signature block                 |
| `surface-light`     | `#faf8f4` | Light sections (about, work, stack)    |
| `surface-light-alt` | `#f2efe7` | Light alternating sections             |
| `foreground`        | `#12121a` | Body text on light                     |
| `foreground-muted`  | `#6b6860` | Muted text on light                    |
| `foreground-light`  | `#faf8f4` | Body text on dark                      |
| `accent-primary`    | `#00d4ff` | Cyan — primary accent (links, prompts) |
| `accent-secondary`  | `#ff7a3d` | Coral — CTA buttons, emphasis          |
| `accent-tertiary`   | `#2e7fff` | Blue — used in footer rule             |
| `border`            | `#1f1f2a` | Borders on dark surfaces               |
| `border-light`      | `#d9d4c5` | Borders on light surfaces              |

### 4.2 Typography

Two font families. Self-hosted in `assets/fonts/` (no Google Fonts at runtime).

| Slug   | Family         | Weights            | Used for                          |
| ------ | -------------- | ------------------ | --------------------------------- |
| `sans` | Inter          | 400, 500, 600, 700 | Body, paragraphs, lists           |
| `mono` | JetBrains Mono | 400, 500, 600, 700 | Headings, prompts, code, metadata |

**Font sizes** — fluid via `clamp()`:

| Slug       | Min      | Max      | Used for         |
| ---------- | -------- | -------- | ---------------- |
| `small`    | 0.875rem | 0.875rem | Captions, meta   |
| `medium`   | 1rem     | 1.125rem | Body             |
| `large`    | 1.125rem | 1.25rem  | Lead paragraphs  |
| `x-large`  | 1.5rem   | 2rem     | Section labels   |
| `xx-large` | 2.5rem   | 3.5rem   | Section headings |
| `huge`     | 4rem     | 6rem     | Hero `<h1>`      |

### 4.3 Spacing

Use `spacingScale` (one-line config) over `spacingSizes`. Steps: 6,
multiplier: 1.5, base: 1rem.

### 4.4 Layout

| Property      | Value    |
| ------------- | -------- |
| `contentSize` | `720px`  |
| `wideSize`    | `1440px` |

### 4.5 `appearanceTools: true`

Single setting that enables in the editor: border (color, radius, style,
width), color (link, heading, button, caption), spacing (margin, padding,
blockGap), typography (lineHeight). Avoids listing each property
individually. **This is the closest FSE has to "utility classes" — and it's
free with one boolean.**

### 4.6 Custom CSS Strategy

Three places custom CSS may live, in priority order:

1. **`theme.json` → top-level `styles.css` field.** Inline rules that ship
   with the design system. Used for: terminal cursor blink animation,
   marquee scroll keyframes, anything tied to a specific design token.

2. **`style.css` at theme root.** Auto-enqueued by WordPress. Used only for
   selectors that cannot be expressed via blocks or block style variations
   (rare). Keep this file under 50 lines.

3. **Block style variations** registered in `theme.json` `styles.blocks.{block}.variations`.
   Used when a specific block (e.g., `core/group`) needs a named visual
   treatment exposed in the editor sidebar (e.g., "Terminal Card",
   "Profile Slot").

**Forbidden:**

- Inline `style=""` attributes inside template HTML or pattern markup
- `<style>` tags inside patterns or template parts
- Any external stylesheet enqueued via `functions.php` (the only PHP
  enqueue we permit is for self-hosted font files, registered through
  `theme.json` `typography.fontFamilies.fontFace`)

---

## 5. Templates

| Template                 | Purpose                                 | Built from                                                                                             |
| ------------------------ | --------------------------------------- | ------------------------------------------------------------------------------------------------------ | --- |
| `index.html`             | Homepage — full Wapuu portfolio landing | header → hero → marquee → about → work-list → toolbox → writing-grid → community-events → cta → footer |
| `archive-portfolio.html` | Portfolio CPT archive (`/projects/`)    | header → page header → Query Loop (post_type=portfolio) → footer                                       |
| `single-portfolio.html`  | Single Portfolio project                | header → project hero → project content → CTA → footer                                                 |
| `archive.html`           | Generic archive fallback (tags, dates)  | header → page header → Query Loop → footer                                                             |
| `single.html`            | Generic single post fallback            | header → post content → CTA → footer                                                                   |
| `page.html`              | Generic page                            | header → page title → content → footer                                                                 |
| `404.html`               | Terminal-style 404                      | header → terminal-error pattern → footer                                                               |
| `search.html`            | Search results                          | header → search form → Query Loop → footer                                                             |     |

---

## 6. Patterns

All patterns registered under category `portfolio-fse` (registered in
`functions.php` via `register_block_pattern_category`).

| Pattern slug       | Block category | Used in                   |
| ------------------ | -------------- | ------------------------- |
| `hero`             | header         | `index.html`              |
| `marquee`          | banner         | `index.html`              |
| `about-section`    | text           | `index.html`, `page.html` |
| `work-list`        | query          | `index.html`              |
| `project-card`     | query          | inside Query Loop         |
| `toolbox`          | features       | `index.html`              |
| `writing-grid`     | posts          | `index.html`              |
| `community-events` | features       | `index.html`              |
| `cta-section`      | call-to-action | `index.html`, `page.html` |

`functions.php` registers three things on `init`: the pattern category,
the `portfolio` CPT, and the `technology` taxonomy. Nothing else — no
style enqueue, no nav menu registration, no widgets, no customizer.
Font enqueue is handled by `theme.json` `typography.fontFamilies.fontFace`.

---

## 7. Governance Strategy (`05-governance` branch)

| Element                                  | Lock type                             | Effect                                     |
| ---------------------------------------- | ------------------------------------- | ------------------------------------------ |
| `parts/header.html` (root group)         | `templateLock: "all"`                 | Editor cannot move or remove header blocks |
| `parts/footer.html` (root group)         | `templateLock: "all"`                 | Same for footer                            |
| `hero` pattern outer group               | `lock: { move: true, remove: true }`  | Layout fixed, copy editable                |
| `project-card` pattern inside Query Loop | `templateLock: "contentOnly"`         | Editors update text/image, not layout      |
| Query Loop block on `index.html`         | `lock: { move: false, remove: true }` | Cannot delete the Projects section         |

---

## 8. Theme-Build TODO

These are the theme-only tasks (split from the project-level TODO).
Each maps to one of the workshop checkpoint branches.

- [ ] **Task 2 — `01-start` branch.** Scaffold an empty block theme using
      the Create Block Theme plugin → "Create Blank Theme". Activate.
      Commit. Verify the site loads with no fatal errors and an empty white
      page.

- [ ] **Task 3 — `02-styles` branch.** Configure `theme.json` per Section 4.
  - [ ] Color palette (Section 4.1)
  - [ ] Typography families + fluid sizes (Section 4.2)
  - [ ] Spacing scale (Section 4.3)
  - [ ] Layout sizes (Section 4.4)
  - [ ] `appearanceTools: true` (Section 4.5)
  - [ ] Self-host Inter + JetBrains Mono in `assets/fonts/`, register in
        `theme.json` `typography.fontFamilies.fontFace`

- [ ] **Task 4 — `03-patterns` branch.** Build patterns per Section 6.
  - [ ] Bootstrap `functions.php`:
    - [ ] Register `portfolio-fse` pattern category
    - [ ] Register `portfolio` CPT (`show_in_rest => true`,
          `has_archive => true`, rewrite slug `projects`)
    - [ ] Register `technology` taxonomy (`show_in_rest => true`)
  - [ ] Flush permalinks (Settings → Permalinks → Save) — required
        for `/projects/` URL to work
  - [ ] Smoke test: create one test Project in admin, confirm
        `/projects/test-project/` loads on frontend
  - [ ] Header part (`parts/header.html`)
  - [ ] Footer part (`parts/footer.html`)
  - [ ] `hero` pattern
  - [ ] `marquee` pattern
  - [ ] `about-section` pattern
  - [ ] `toolbox` pattern
  - [ ] `cta-section` pattern
  - [ ] Build `index.html` template assembling these patterns

- [ ] **Task 5 — `04-portfolio-archive` branch.**
  - [ ] `project-card` pattern (used inside Query Loop)
  - [ ] `work-list` pattern (Query Loop on `portfolio` post type,
        wrapping `project-card`)
  - [ ] `archive-portfolio.html` template — Query Loop on `portfolio` CPT
  - [ ] `single-portfolio.html` template
  - [ ] Add `work-list` pattern to `index.html`
  - [ ] `writing-grid` pattern (Query Loop on Posts — keep for blog)
  - [ ] `community-events` pattern
  - [ ] Demonstrate template hierarchy:
        `archive-portfolio.html` → `archive.html` → `index.html`
        as fallback chain (live demo: rename and reload)

- [ ] **Task 6 — `05-governance` branch.** Apply locking per Section 7.
  - [ ] Template-level lock on header / footer parts
  - [ ] Block-level lock on hero outer group
  - [ ] Content-only mode on project-card
  - [ ] Lock Query Loop block on `index.html`
  - [ ] Test: try to break the layout as an Editor user

- [ ] **Task 6b — Final polish on `main`.**
  - [ ] `single.html`, `page.html`, `404.html`, `search.html`
  - [ ] `screenshot.png` (1200×900)
  - [ ] Theme description + tags in `style.css` header
