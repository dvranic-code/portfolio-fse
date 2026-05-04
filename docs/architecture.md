# portfolio-fse — Theme Architecture

Technical blueprint for the theme. This is the contract between Dejan and Claude: every
implementation decision is documented here so the build can stay on schedule.

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

## 2. File Structure (current)

```
portfolio-fse/
├── style.css                    # theme header + custom CSS (~50 lines)
├── theme.json                   # design system: colors, typography, spacing, layout, button variations
├── functions.php                # pattern category + CPT + taxonomies + button styles + style.css enqueue
├── README.md                    # public-facing repo readme (final task)
├── screenshot.png               # 1200×900 theme screenshot
├── claude.md                    # theme rules + design log (gitignored)
├── docs/
│   └── architecture.md          # this file
├── templates/
│   ├── front-page.html          # homepage — Wapuu landing
│   ├── index.html               # universal fallback (plugin default)
│   ├── page.html                # generic page
│   ├── page-no-title.html       # custom template (Page Settings dropdown)
│   ├── archive-portfolio.html   # Portfolio CPT archive (/projects/) [Task 5]
│   ├── single-portfolio.html    # Single Portfolio project [Task 5]
│   ├── archive.html             # generic archive fallback [Task 6b]
│   ├── single.html              # generic single fallback [Task 6b]
│   ├── 404.html                 # terminal 404 [Task 6b]
│   └── search.html              # search results [Task 6b]
├── parts/
│   ├── header.html
│   └── footer.html
├── patterns/
│   ├── hero.php                 # homepage hero (static)
│   ├── lead-paragraph.php       # narrative section (static)
│   ├── toolbox.php              # tech stack grid (static)
│   ├── toolbox-card.php         # toolbox card sub-pattern (static)
│   ├── cta-banner.php           # bottom CTA (static)
│   ├── work-list.php            # Query Loop wrapper for Portfolio CPT
│   ├── project-card.php         # project row, used inside work-list Post Template
│   ├── blog-list.php            # Query Loop wrapper for Posts (sticky excluded)
│   └── blog-card.php            # blog card, used inside blog-list Post Template
└── assets/
    └── fonts/                   # self-hosted Inter + JetBrains Mono
```

---

## 3. Architectural Principles

### 3.1 PHP → FSE Mental Model (the workshop's core teaching)

| Classic PHP                                 | FSE Equivalent                                             | Lives in            |
| ------------------------------------------- | ---------------------------------------------------------- | ------------------- |
| `wp_enqueue_style()` for design tokens      | Design tokens in `theme.json`                              | `theme.json`        |
| `wp_enqueue_style()` for theme stylesheet   | Still required for `style.css`                             | `functions.php`     |
| `header.php`                                | Template part                                              | `parts/header.html` |
| `footer.php`                                | Template part                                              | `parts/footer.html` |
| `WP_Query` + `while (have_posts())`         | Query Loop block                                           | template or pattern |
| `get_template_part('hero')`                 | Synced or unsynced Pattern                                 | `patterns/hero.php` |
| `page.php`, `single.php`, etc.              | Block templates (HTML)                                     | `templates/*.html`  |
| `front-page.php` → `home.php` → `index.php` | `front-page.html` → `home.html` → `index.html`             | same hierarchy      |
| `register_post_type()` for Projects         | `portfolio` CPT + `technology` + `project_type` taxonomies | `functions.php`     |
| `@media (max-width)` for column stacking    | Group layout: grid with min column width                   | block UI            |
| Conditional CSS (`is_front_page`)           | Block-level style variations                               | block markup        |

### 3.2 Custom Post Type for Projects

Projects use a dedicated `portfolio` Custom Post Type with two custom taxonomies:
`technology` and `project_type`. All registered in `functions.php` on the `init` hook, all
with `show_in_rest => true`. Rationale:

- **Real-world fit.** Agencies and freelancers ship CPTs on every project — services,
  projects, team, testimonials. Filtering Posts by category is the toy version of what the
  audience actually builds at work.
- **Better Query Loop teaching.** Demonstrating Query Loop with a real CPT — the most common
  production scenario — beats demonstrating it with a category filter on Posts.
- **`show_in_rest => true` is critical.** Without it, the Block Editor falls back to classic
  editor and the Query Loop block cannot query the CPT. This is the #1 gotcha for PHP devs
  migrating from classic themes — explicit teaching moment in workshop.
- **Cost: ~5–7 minutes of focused PHP** in the early workshop. The promise shifts from
  "almost no PHP" to "minimal, targeted PHP — only what FSE cannot do itself".
- **Permalinks must be flushed** (Settings → Permalinks → Save Changes) after first
  activation, otherwise `/projects/` returns 404. Standard CPT gotcha.

Two taxonomies, not one:

- `technology` → tech tags (FSE, WooCommerce, WP-CLI, etc.). Renders as tag list in
  project card.
- `project_type` → category-style label (block theme, theme + plugin, woo theme, etc.).
  Renders as subtitle text in project card.

### 3.3 No Build Step, FSE-Native Styling

Theme ships as plain PHP/HTML/CSS/JSON. **No npm, no Tailwind, no SCSS, no PostCSS,
no Vite.** Rationale:

- **Workshop teaches FSE.** A utility-class framework like Tailwind contradicts the core
  teaching that `theme.json` is the design system. 60% of the audience are experienced devs
  — they will spot the contradiction and lose trust.
- **Create Block Theme plugin compatibility.** "Save Changes to Theme" pushes Site Editor
  edits back into `theme.json` and template HTML. A build step that scans source files
  cannot see classes added via the editor UI.
- **Attendee debuggability.** No node version mismatch, no failed `npm install`. Drop the
  theme folder, activate, work.

---

## 4. Design System (`theme.json`)

### 4.1 Color Palette (12 semantic-slug colors)

| Slug                | Color     | Usage                                  |
| ------------------- | --------- | -------------------------------------- |
| `background`        | `#0a0a0f` | Reserved for dark sections (hero, CTA) |
| `background-alt`    | `#10101a` | Reserved variant                       |
| `surface-light`     | `#faf8f4` | Site default background                |
| `surface-light-alt` | `#f2efe7` | Alt sections (toolbox, blog-list)      |
| `foreground`        | `#12121a` | Body text                              |
| `foreground-muted`  | `#6b6860` | Secondary text, meta                   |
| `foreground-light`  | `#ffffff` | Text on dark sections                  |
| `accent-primary`    | `#00d4ff` | Cyan — primary calls-to-action         |
| `accent-secondary`  | `#ff7a3d` | Coral — links, accent text             |
| `accent-tertiary`   | `#2e7fff` | Blue — minor accent                    |
| `border`            | `#1f1f2a` | Dark section borders                   |
| `border-light`      | `#d9d4c5` | Light section borders                  |

`color.defaultPalette: false` — WP core palette is hidden from inserter dropdowns. Only
theme-defined colors visible.

### 4.2 Typography

| Family         | Slug   | Weights            | Self-hosted                           |
| -------------- | ------ | ------------------ | ------------------------------------- |
| Inter          | `sans` | 400, 500, 600, 700 | `assets/fonts/inter/*.woff2`          |
| JetBrains Mono | `mono` | 400, 500, 600, 700 | `assets/fonts/jetbrains-mono/*.woff2` |

`fluid: true` enables `clamp(min, ideal, max)` formula generation per font size.

| Slug       | Size     | Fluid | Min      | Max      |
| ---------- | -------- | ----- | -------- | -------- |
| `small`    | 0.875rem | no    | —        | —        |
| `medium`   | 1.125rem | yes   | 1rem     | 1.125rem |
| `large`    | 1.25rem  | yes   | 1.125rem | 1.25rem  |
| `x-large`  | 2rem     | yes   | 1.5rem   | 2rem     |
| `xx-large` | 3.5rem   | yes   | 2.5rem   | 3.5rem   |
| `huge`     | 6rem     | yes   | 4rem     | 6rem     |

`defaultFontSizes: false` — WP core sizes hidden.

`styles.elements.h1` through `h6` all set to `font-family: var:preset|font-family|mono`.
`h2` and `h3` get explicit `fontSize` and `lineHeight` (1.05 and 1.2 respectively). `h1`
gets `lineHeight: 1`.

### 4.3 Spacing Scale

`spacing.spacingScale`: operator `*`, increment 1.5, 6 steps, mediumStep 1, unit `rem`.
Generates 6 tokens: `spacing-20` through `spacing-80`.

### 4.4 Layout

| Property      | Value    |
| ------------- | -------- |
| `contentSize` | `720px`  |
| `wideSize`    | `1440px` |

### 4.5 `appearanceTools: true`

Single setting that enables in the editor: border (color, radius, style, width), color
(link, heading, button, caption), spacing (margin, padding, blockGap), typography
(lineHeight). Closest FSE has to "utility classes" — free with one boolean.

### 4.6 Custom CSS Strategy

Three places custom CSS may live, with clear decision rules:

1. **`style.css` at theme root.** Default destination for any custom CSS beyond a few
   lines. **In block themes, `style.css` is NOT auto-enqueued** (unlike classic themes).
   Must be enqueued via `wp_enqueue_style('portfolio-fse-style', get_stylesheet_uri(), [],
wp_get_theme()->get('Version'))` inside a `wp_enqueue_scripts` action callback in
   `functions.php`. This is the only PHP enqueue ceremony we permit, and it exists
   precisely because FSE has not removed it yet. Use proper CSS syntax with full file
   structure. Reference `theme.json` tokens via `var(--wp--preset--{category}--{slug})`.
   Used for: button hover states (until WP 7.0), keyboard focus rings, `<code>` element
   styling, project card responsive breakpoints, blog-card equal-height grid.

2. **`theme.json` → top-level `styles.css` field.** Reserve for very short (1-3 lines)
   inline rules tied tightly to a single design token. Loaded inline by WP, no enqueue
   needed. Avoid for anything multi-line — JSON doesn't support multi-line strings cleanly.
   Currently unused in our build.

3. **Block style variations registered in `theme.json`
   `styles.blocks.{block}.variations`.** First-class FSE primitive. Used for color,
   border, typography, spacing of a named variation. In WP 6.9, variation-level `:hover`
   does NOT work here — falls back to layer 1 (`style.css`). Starting WP 7.0, `:hover`,
   `:focus`, `:focus-visible`, and `:active` work directly in variations. Currently used
   for `core/button` Primary + Secondary variations.

**Decision tree:**

- Is the target a registered `theme.json` element (`button`, `link`, `h1`–`h6`, `cite`,
  `caption`, `heading`)? Or a core block (`core/paragraph`, `core/code`...)?
  → use `theme.json` `styles.elements.{name}` or `styles.blocks.{name}` (layer 3)
- Is the target an HTML element NOT in the closed elements set (`code`, `pre`, `mark`,
  `kbd`, `strong`, `em`, `table`, etc.)?
  → `style.css` at theme root, with CSS variables referencing `theme.json` tokens (layer 1)
- Does the rule require a pseudo-class on a block/variation not yet supported in
  `theme.json` (button hover until WP 7.0)?
  → `style.css` at theme root (layer 1)
- Is the rule a 1-3 line snippet tied to a single token?
  → `theme.json` `styles.css` field (layer 2) is acceptable

**The closed elements set in `theme.json` `styles.elements`:** `button`, `link`,
`heading`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `cite`, `caption`. Everything else goes in
`style.css`.

**Forbidden:**

- Inline `style=""` attributes inside template HTML or pattern markup (other than what
  the editor itself generates as block attributes)
- `<style>` tags inside patterns or template parts
- Any **third-party** stylesheet enqueued via `functions.php` (Bootstrap, Tailwind,
  etc.). Self-hosted font files registered through `theme.json`
  `typography.fontFamilies.fontFace` are exempt.
- Note: enqueuing the theme's own `style.css` IS required in block themes and is not
  "forbidden enqueue" — it is the standard FSE bridge until WP makes this automatic.

**Pending WP 7.0 migration:**

When the production WordPress reaches 7.0, button hover CSS in `style.css` should migrate
back into `theme.json` `styles.blocks.core/button.variations.{name}.:hover`. The
`_comment_hover` documentation keys in `theme.json` already mark the migration sites. If
after migration `style.css` has zero rules below the metadata header, the
`wp_enqueue_style` call in `functions.php` can be removed too. Tracked in theme
`claude.md`.

---

## 5. Templates

| Template                 | Purpose                                       | Built from                                                                                                 |
| ------------------------ | --------------------------------------------- | ---------------------------------------------------------------------------------------------------------- |
| `front-page.html`        | Homepage — Wapuu landing (URL `/`)            | header → hero → lead-paragraph → work-list → toolbox → blog-list → cta-banner → footer                     |
| `index.html`             | Universal fallback (anything unmatched)       | header → Query Loop → footer (plugin default kept)                                                         |
| `page.html`              | Generic Page                                  | header → main(alignfull) → post-title(wide) → post-content(alignfull, constrained) → footer                |
| `page-no-title.html`     | Custom template — Page without title          | header → main(alignfull) → featured-image(alignfull, 21/9) → post-content(alignfull, constrained) → footer |
| `archive-portfolio.html` | Portfolio CPT archive (`/projects/`) [Task 5] | header → page header → Query Loop (post_type=portfolio, inherit) → footer                                  |
| `single-portfolio.html`  | Single Portfolio project [Task 5]             | header → project hero → project content → CTA → footer                                                     |
| `archive.html`           | Generic archive fallback [Task 6b]            | header → page header → Query Loop → footer                                                                 |
| `single.html`            | Generic single post fallback [Task 6b]        | header → post content → CTA → footer                                                                       |
| `404.html`               | Terminal-style 404 [Task 6b]                  | header → terminal-error pattern → footer                                                                   |
| `search.html`            | Search results [Task 6b]                      | header → search form → Query Loop → footer                                                                 |

**Custom templates** are registered in `theme.json` under top-level `customTemplates`
array. Each entry maps a slug to a display title and a list of post types that can use it.
Custom templates appear in the Template dropdown of a post/page's sidebar — users can apply
them without dev intervention. Currently registered: `page-no-title` (postTypes: page).

---

## 6. Patterns

All patterns registered under category `portfolio-fse` (registered in `functions.php` via
`register_block_pattern_category`). WP core auto-registers all `*.php` files in `patterns/`
folder via `init` hook scan.

| Pattern slug     | Type   | Used in                                              | Notes                                                               |
| ---------------- | ------ | ---------------------------------------------------- | ------------------------------------------------------------------- |
| `hero`           | static | `front-page.html`                                    | Headline + lead + buttons + stats                                   |
| `lead-paragraph` | static | `front-page.html`                                    | About-style narrative section                                       |
| `toolbox`        | static | `front-page.html`                                    | 4-card grid via Group with grid layout                              |
| `toolbox-card`   | static | inside `toolbox`                                     | Reusable card composition                                           |
| `cta-banner`     | static | `front-page.html`                                    | Bottom CTA section                                                  |
| `work-list`      | query  | `front-page.html`, `archive-portfolio.html` [Task 5] | Query Loop wrapper, Portfolio CPT, perPage 5                        |
| `project-card`   | query  | inside `work-list` Post Template                     | `Block Types: core/post-template, core/query`                       |
| `blog-list`      | query  | `front-page.html`                                    | Query Loop wrapper, Posts, sticky excluded, grid layout             |
| `blog-card`      | query  | inside `blog-list` Post Template                     | `Block Types: core/post-template, core/query`, equal-height via CSS |

`functions.php` registers five things: pattern category, `portfolio` CPT, `technology` and
`project_type` taxonomies, button style variations (Primary + Secondary), and `style.css`
enqueue. Nothing else — no nav menu registration, no widgets, no customizer. Font enqueue
is handled by `theme.json` `typography.fontFamilies.fontFace`.

---

## 7. Governance Strategy (`05-governance` branch — Task 6)

| Element                                  | Lock type                             | Effect                                     |
| ---------------------------------------- | ------------------------------------- | ------------------------------------------ |
| `parts/header.html` (root group)         | `templateLock: "all"`                 | Editor cannot move or remove header blocks |
| `parts/footer.html` (root group)         | `templateLock: "all"`                 | Same for footer                            |
| `hero` pattern outer group               | `lock: { move: true, remove: true }`  | Layout fixed, copy editable                |
| `project-card` pattern inside Query Loop | `templateLock: "contentOnly"`         | Editors update text/image, not layout      |
| Query Loop block on `front-page.html`    | `lock: { move: false, remove: true }` | Cannot delete the Projects section         |

---

## 8. Theme-Build TODO

These are the theme-only tasks (split from the project-level TODO). Each maps to one of
the workshop checkpoint branches.

- [x] **Task 2 — `01-start` branch.** Scaffold an empty block theme using the Create Block
      Theme plugin → "Create Blank Theme". Activate. Commit. Verify the site loads with no
      fatal errors and an empty white page.

- [x] **Task 3 — `02-styles` branch.** Configure `theme.json` per Section 4.
  - [x] Color palette (Section 4.1)
  - [x] Typography families + fluid sizes (Section 4.2)
  - [x] Spacing scale (Section 4.3)
  - [x] Layout sizes (Section 4.4)
  - [x] `appearanceTools: true` (Section 4.5)
  - [x] Self-host Inter + JetBrains Mono in `assets/fonts/`, register in `theme.json`
        `typography.fontFamilies.fontFace`

- [x] **Task 4 — `03-patterns` branch.** Build patterns per Section 6.
  - [x] Bootstrap `functions.php`:
    - [x] Register `portfolio-fse` pattern category
    - [x] Register `portfolio` CPT (`show_in_rest => true`, `has_archive => true`,
          rewrite slug `projects`)
    - [x] Register `technology` taxonomy (`show_in_rest => true`)
    - [x] Register `project_type` taxonomy (`show_in_rest => true`)
    - [x] Register `core/button` Primary + Secondary style variations
    - [x] Enqueue `style.css` via `wp_enqueue_scripts` (block themes don't auto-enqueue)
  - [x] Flush permalinks
  - [x] Smoke test CPT permalinks
  - [x] `hero` pattern (static)
  - [x] `lead-paragraph` pattern (static, replaces planned `about-section`)
  - [x] `toolbox` pattern (static, with `toolbox-card` sub-pattern)
  - [x] `cta-banner` pattern (static, replaces planned `cta-section`)
  - [x] `work-list` pattern (query, Portfolio CPT)
  - [x] `project-card` pattern (query item)
  - [x] `blog-list` pattern (query, Posts, replaces planned `writing-grid`)
  - [x] `blog-card` pattern (query item)
  - [x] Custom CSS in `style.css`: button hovers, code element, project card responsive,
        blog card equal-height
  - [x] Build `front-page.html` template assembling these patterns
  - [x] Build `page.html` template
  - [x] Build `page-no-title.html` custom template + register in `theme.json`
        `customTemplates`

- [ ] **Task 5 — `04-portfolio-archive` branch.**
  - [ ] `archive-portfolio.html` template — reuses `work-list` pattern, demonstrates that
        same pattern works in two contexts (homepage + archive)
  - [ ] `single-portfolio.html` template — single project detail page
  - [ ] Demonstrate template hierarchy live: rename `archive-portfolio.html` →
        `archive.html` → `index.html` fallback chain

- [ ] **Task 6 — `05-governance` branch.** Apply locking per Section 7.
  - [ ] Template-level lock on header / footer parts
  - [ ] Block-level lock on hero outer group
  - [ ] Content-only mode on project-card
  - [ ] Lock Query Loop block on `front-page.html`
  - [ ] Test: try to break the layout as an Editor user

- [ ] **Task 6b — Final polish on `main`.**
  - [ ] `single.html`, `archive.html`, `404.html`, `search.html`
  - [ ] `screenshot.png` (1200×900)
  - [ ] `style.css` header polish (Requires WP 6.6, accurate Description, Tags)
  - [ ] `readme.txt` cleanup
  - [ ] Removed `Inserter: no` from `project-card.php` (confirmed working)

- [ ] **Task 7 — Sample content.** Export current 5+ Portfolio CPT entries + Posts to WXR
      file. Attendees import after pulling `03-patterns` branch.
