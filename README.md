<p align="center" style="display: flex; justify-content:center; gap: 10px; width: 100%">
<img alt="Static Badge" src="https://img.shields.io/badge/Laravel%2013-version?style=plastic&logo=laravel&logoColor=white&labelColor=%23FF2D20&color=black">
<img alt="Static Badge" src="https://img.shields.io/badge/DaisyUI%205-version?style=plastic&logo=daisyui&logoColor=white&labelColor=%231AD1A5&color=black">
<img alt="Static Badge" src="https://img.shields.io/badge/Livewire%204-version?style=plastic&logo=livewire&logoColor=white&labelColor=%234E56A6&color=black">
<img alt="Static Badge" src="https://img.shields.io/badge/FontAwesome%207-version?style=plastic&logo=fontawesome&logoColor=white&labelColor=%23538DD7&color=black">
</p>

<div style="display: flex; justify-content:center; gap: .4em; width: 100%">
<a href="https://github.com/ElisameAraujo/simple-dashboard">
Readme (English)
</a>
|
<a href="https://github.com/ElisameAraujo/simple-dashboard/blob/main/README.pt-br.md">
Readme (Português do Brasil)
</a>
</div>

# Simple Dashboard

A simple, modern, and functional administrative panel, built with:

-   **Laravel 13+**
-   **Livewire 4+**
-   **Tailwind CSS 4+**
-   **DaisyUI 5+**
-   **FontAwesome 7+**

The goal of this project is to serve as a **starting base** for creating dashboards, offering a clean, organized structure with a set of ready-to-use helpers.

This project is provided **AS IS**. Updates may occur occasionally, if I seen necessary.

---

# 🚀 Quick Installation

```bash
git clone https://github.com/ElisameAraujo/simple-dashboard.git
cd simple-dashboard

composer install
npm install
npm run build

cp .env.example .env
php artisan key:generate

composer run dev
```

---

# 📦 Requirements

-   **PHP 8.3+**
-   **Laravel 13+**
-   **Node 20+**
-   **Composer 2+**

---

# 🗂 Project Structure (Summary)

```
.
├── app/
│   ├── ...
│   ├── Helpers (Global Helpers)/
│   │   ├── Support/
│   │   │   └── LocaleResolver.php
│   │   ├── DateHelper.php
│   │   ├── DiskHelper.php
|   |   ├── HTMLHelper.php
│   │   ├── MediaHelper.php
│   │   ├── NotificationHelper.php
│   │   ├── NumberHelper.php
│   │   ├── PaginationHelper.php
│   │   ├── RouteHelper.php
│   │   ├── RuleHelper.php
│   │   ├── TextHelper.php
│   │   └── UserHelper.php
│   ├── ...
│   └── Providers/
│       ├── ...
│       └── HelperServiceProvider.php (Service Provider for Helpers)
├── ...
├── config/
│   ├── ...
│   └── helpers.php (Helpers Registry)
├── ...
├── documentation/
│   ├── en-US/
│   │   ├── DateHelper.md
│   │   ├── DiskHelper.md
│   │   ├── HTMLHelper.md
│   │   ├── MediaHelper.md
│   │   ├── NotificationHelper.md
│   │   ├── NumberHelper.md
│   │   ├── PaginationHelper.md
│   │   ├── RouteHelper.md
│   │   ├── RuleHelper.md
│   │   ├── TextHelper.md
│   │   └── UserHelper.md
│   └── pt-BR/
│       ├── DateHelper.md
│       ├── DiskHelper.md
│       ├── HTMLHelper.md
│       ├── MediaHelper.md
│       ├── NotificationHelper.md
│       ├── NumberHelper.md
│       ├── PaginationHelper.md
│       ├── RouteHelper.md
│       ├── RuleHelper.md
│       ├── TextHelper.md
│       └── UserHelper.md
├── lang/
│   ├── en/
│   │   ├── dates.php
│   │   ├── error_messages.php
│   │   ├── plurals.php
│   │   └── ui.php
│   └── pt-BR/
│       ├── dates.php
│       ├── error_messages.php
│       ├── plurals.php
│       └── ui.php
├── ...
├── resources/
│   ├── css/
│   │   ├── admin/
│   │   │   └── components/
│   │   │       ├── dark.css
│   │   │       ├── header.css
│   │   │       ├── profile-options.css
│   │   │       ├── search-modal.css
│   │   │       └── sidebar.css
│   │   ├── global/
│   │   │   ├── theme.css
│   │   │   └── utilities.css
│   │   └── web/
│   │       ├── style.css
│   │       └── web.css
│   ├── js/
│   │   ├── admin/
│   │   │   ├── admin.js
│   │   │   ├── mobile-menu.js
│   │   │   ├── search-modal.js
│   │   │   └── submenu.js
│   │   └── web/
│   └── views/
│       ├── admin/
│       │   ├── dashboard/
│       │   │   └── index.blade.php
│       │   └── profile/
│       │       ├── my-profile.blade.php
│       │       ├── notifications.blade.php
│       │       └── security.blade.php
│       ├── components/
│       │   └── admin/
│       │       ├── header.blade.php
│       │       ├── menu-structrure.blade.php
│       │       ├── search-modal.blade.php
│       │       ├── side-menu.blade-mobile.php
│       │       └── side-menu.blade.php
│       ├── layouts/
│       │    └── admin.blade.php
|       └── web/
├── routes/
│   ├── admin/
│   │   ├── dashboard/
│   │   │   └── dashboard-routes.php
│   │   └── profile/
│   │       └── profile-routes.php
|   └── web/
└── ...
```

---

# 🧰 Helpers

This project already has a small list of helpers with static functions that can be accessed globally via `ClassName::function()`.

You can create new helpers within the `App\Helpers` folder and register them in the `config\helpers.php` file under the `global` key.

You can check what each helper and function does in the [**`/documentation`**](https://github.com/ElisameAraujo/simple-dashboard/tree/main/documentation) folder. There you will find specific files for each class and also for the functions within each class. Within the classes you will also find comments for more specific functions.

The currently available helpers are:

| Helper                 | Description                                 |
| ---------------------- | ------------------------------------------- |
| **DateHelper**         | Date manipulation and formatting            |
| **DiskHelper**         | Laravel disk and path management            |
| **HTMLHelper**         | Create HTML for factories                   |
| **MediaHelper**        | Disk media display and management           |
| **NotificationHelper** | Laravel notification management             |
| **NumberHelper**       | Multi-language numeric formatting           |
| **PaginationHelper**   | Build pagination with multiple parts        |
| **RoutesHelper**       | Importing application route files           |
| **RuleHelper**         | Extract values from rules or DTO Classes    |
| **TextHelper**         | Cleaning, normalization, and pluralization  |
| **UserHelper**         | Quick access to data from the `User` model. |

---

# 🎨 Themes (DaisyUI)

This panel uses [**DaisyUI 5+**](https://daisyui.com/), which offers native theme support and contains a library of ready-to-use [components](https://daisyui.com/components/).

🔗 **List of Official Themes:**

[https://daisyui.com/docs/themes/](https://daisyui.com/docs/themes/)

🔗 **Theme Generator:**

[https://daisyui.com/theme-generator/](https://daisyui.com/theme-generator/)

Defining a theme:

```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
    <head>
        ...
    </head>
</html>
```

If you want to replace or edit the current theme, simply edit the `theme.css` file inside `resources/global`.

---

# 🧩 Extra Packages Included

### 📦 NPM

-   **[Theme Change](https://github.com/saadeghi/theme-change)** — Theme switching with persistence via cookie

### 📦 Composer

-   **[Spatie Media Library](https://github.com/spatie/laravel-medialibrary)** — Media management that is linked to Eloquent Models
-   **[Spatie Laravel Permission](https://github.com/spatie/laravel-permission)** — Roles and permissions management
-   **[Log Viewer](https://log-viewer.opcodes.io/)** — It allows you to read your Laravel logs in a clearer and more organized way.

---

# ❓ FAQ

### **Can I use this panel in production?**

Yes, but it is provided _AS IS_. Adjust it according to your needs.

### **Can I remove the pre-installed packages?**

Yes, feel free! The base project is just a guide when you're setting up your administration panel, so if the packages aren't necessary or you don't like them, just use the native Composer or NPM commands to remove them.

### **Can I add my own helpers?**

Yes. Just create them in `app/Helpers` and register them in `config/helpers.php`.

### **Does the panel receive frequent updates?**

I can update the project to support newer versions of the packages already available here, as well as remove or add new packages. But this can only happen occasionally, if I seen it necessary.

### **Can I create forks and variants?**

Yes, feel free.

---

# 🤝 Contribution

Contributions are welcome, especially for:

-   Interface translations
-   Expansion of the plural dictionary
-   Improvements to the helpers
-   General fixes

To contribute:

```bash
git checkout -b my-improvement
git commit -m "Improvement X"
git push origin my-improvement
```

Then open a **Pull Request**.
