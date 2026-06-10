# Simple Dashboard

Simple Dashboard is a ready-to-use Laravel admin panel starter. It ships with a clean dashboard structure, reusable helpers, and optional admin modules that can be adapted to real projects.

If you want to see the features running with fake data and visual examples, use the separate demo repository: [simple-dashboard-demo](https://github.com/ElisameAraujo/simple-dashboard-demo).

## Stack

- Laravel 13
- Livewire 4
- Tailwind CSS 4
- DaisyUI 5
- FontAwesome 7
- Vite 8
- SQLite-ready local setup

## Installation

Clone the starter repository:

```bash
git clone https://github.com/ElisameAraujo/simple-dashboard.git
cd simple-dashboard
```

Install PHP and JavaScript dependencies:

```bash
composer install
npm install
```

Create the environment file, generate the application key, and run migrations:

```bash
cp .env.example .env
php artisan key:generate
php artisan migrate
```

Build frontend assets:

```bash
npm run build
```

Start the local development environment:

```bash
composer run dev
```

Then open:

```text
http://127.0.0.1:8000/admin
```

## What Is Included

### Helpers

Helpers live in `app/Helpers` and are registered through `config/helpers.php`.

| Helper | Focus |
| --- | --- |
| `DateHelper` | Dates, periods, and relative text. |
| `DiskHelper` | Upload, replacement, removal, and URL generation for Laravel disks. |
| `HTMLHelper` | Fake HTML generation for factories, previews, and documentation. |
| `MediaHelper` | Media resolution, display, download, and MIME type helpers. |
| `NotificationHelper` | Reading Laravel notifications for the authenticated user. |
| `NumberHelper` | Locale-aware numbers, currency, area, and ordinals. |
| `PaginationHelper` | Pagination array helpers. |
| `RouteHelper` | Organized import of route files and folders. |
| `RuleHelper` | Extracting values from Laravel validation rules. |
| `TextHelper` | Cleaning, normalization, pluralization, slugs, and UI text. |
| `UserHelper` | Safe access to basic user data and optional permission extras. |

### Modules

Modules are included as reusable building blocks. This starter does not include demo pages for them; check the documentation folder for implementation details.

| Module | Purpose |
| --- | --- |
| `ImagePreview` | Livewire image preview for create and edit forms. |
| `Visits` | Standalone Eloquent visit tracking and popularity scopes. |
| `Notifications UI` | Visual notification components ready to connect to your backend. |
| `Maintenance Mode` | WordPress-style maintenance mode that keeps the admin panel available. |
| `Search Engine` | Configurable search for admin Spotlight, web search, Eloquent models, static items, and Livewire tables. |
| `Rich Text Media` | Upload, commit, sync, cleanup, and deletion flow for images embedded in WYSIWYG editors. |

## Documentation

Documentation is available in:

```text
documentation/en
documentation/pt-BR
```

Useful module docs:

| Topic | English | Portuguese |
| --- | --- | --- |
| ImagePreview | `documentation/en/ImagePreview.md` | `documentation/pt-BR/ImagePreview.md` |
| Visits | `documentation/en/Visits.md` | `documentation/pt-BR/Visits.md` |
| Notifications UI | `documentation/en/NotificationsUI.md` | `documentation/pt-BR/NotificationsUI.md` |
| Maintenance Mode | `documentation/en/MaintenanceMode.md` | `documentation/pt-BR/MaintenanceMode.md` |
| Search Engine | `documentation/en/SearchEngine.md` | `documentation/pt-BR/SearchEngine.md` |
| Rich Text Media | `documentation/en/RichTextMedia.md` | `documentation/pt-BR/RichTextMedia.md` |

## Validation

Run the full test suite:

```bash
php artisan test
```

Build assets:

```bash
npm run build
```

Run a focused module test when changing a specific module:

```bash
php artisan test tests/Feature/Search
php artisan test tests/Feature/Visits
php artisan test tests/Feature/Media
php artisan test --filter=MaintenanceModeTest
```

## Notes

- The project is provided as a starter base. Adapt routes, authorization, models, and UI details to your application.
- Simple confirmation modals use DaisyUI.
- Livewire-powered flows should stay inside Livewire components when validation or state management is required.
- The demo repository contains visual examples; this repository keeps the reusable implementation clean.
