# portfolio-fse — Theme Notes

Theme-specific scratchpad. Project context lives in the root `CLAUDE.md`.
Architecture decisions and theme-build tasks live in `docs/architecture.md`.

---

## CRITICAL RULE — Claude Must Never Write Theme Code

> **Claude (the assistant) is NOT allowed to write, edit, or generate any
> files inside this theme folder.**
>
> Dejan writes every single line of theme code by hand. This is intentional —
> the purpose of this project is to learn FSE by doing it.
>
> ### Allowed
>
> - Explain concepts, architecture, and FSE patterns
> - Show code examples in chat (never written to disk)
> - Provide terminal commands or Claude Code instructions for Dejan to execute
> - Review and give feedback on code Dejan has written
>
> ### Forbidden
>
> - Use Write, Edit, str_replace, or any tool that touches files inside
>   `portfolio-fse/` (except this `claude.md` and `docs/architecture.md`,
>   which are planning documents, not theme code)
> - Generate full theme files (`theme.json`, templates, patterns, PHP) for
>   Dejan to paste verbatim
>
> If Dejan asks Claude to generate theme code, Claude must refuse and instead
> provide:
>
> 1. A short explanation of what's needed
> 2. Pseudocode or a sketch in chat
> 3. The exact location, file name, and key properties to use
> 4. A pointer to relevant FSE docs

---

## Styling Strategy — FSE-Native, No Build Step

This theme uses **only** the styling primitives that ship with WordPress core
and FSE. **No Tailwind, no SCSS, no PostCSS, no npm.** This is a deliberate
constraint, not a limitation. Rationale:

1. **The workshop teaches FSE.** Adding a parallel utility-class system
   contradicts the core message: `theme.json` is the design system.
2. **No build step.** Workshop attendees cannot debug missing or stale build
   output during a 75-minute session.
3. **Create Block Theme plugin compatibility.** "Save Changes to Theme"
   writes Site Editor edits back into `theme.json` and template HTML. A
   utility-class build pipeline cannot see classes added through the editor
   UI — the workshop's main demo would silently break.
4. **Self-hosted fonts.** Inter + JetBrains Mono in `assets/fonts/`. No
   Google Fonts at runtime — matches Wapuu persona's "no JS, no Google
   Fonts" stance.

What replaces a utility framework:

| Need                                         | FSE-native answer                         |
| -------------------------------------------- | ----------------------------------------- |
| Padding / margin / border controls in editor | `appearanceTools: true`                   |
| Reusable spacing tokens                      | `spacingScale` in `theme.json`            |
| Responsive font sizes                        | Fluid `clamp()` values in `theme.json`    |
| Reusable component looks                     | Block style variations                    |
| One-off animations / pseudo-elements         | `style.css` at theme root (auto-enqueued) |
| Global custom CSS                            | `theme.json` → `styles.css` field         |

**Visual fidelity to `console-home.html`: ~70–80%.** Pixel-perfect match is
explicitly out of scope. `console-home.html` is a guide, not a spec.

---

## Design Reference

Visual source of truth (guide, not spec): `../../../../console-home.html`
(project root).

---

## Theme-Specific TODO

- [ ] **End of project — Generate a professional `README.md`** for the GitHub
      repo root. Must cover:
  - Project purpose (WCEU 2026 workshop demo theme)
  - Audience (workshop attendees, FSE learners)
  - Install / activate instructions
  - Branch checkpoint guide (how to use `01-start` … `05-governance`)
  - Requirements (WordPress version, PHP version, required plugins)

---

## Design Decisions Log

Append decisions as they are made during the build. Format:
YYYY-MM-DD — short title
Decision: …
Rationale: …
File touched: …

<!-- decisions go below this line -->

---

## Build Notes

Free-form notes during the build: blockers, things learned, ideas to revisit.

<!-- notes go below this line -->
