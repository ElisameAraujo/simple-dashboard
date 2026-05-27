# Maintenance Mode

Maintenance control for blocking the public site without taking down the admin panel.

## When To Use

- Use Maintenance Mode when you need to hide the public site from visitors while validating changes.
- Use it as an alternative to `php artisan down` when administrators still need to access the dashboard and browse the authenticated site.
- Apply the middleware to the real public routes of the project. This version does not create an example web page.

## How To Access

The admin screen is available at:

```text
/admin/configs/maintenance
```

It can also be accessed through the sidebar under **Settings > Maintenance**.

## How It Works

The state is stored in the `maintenance_settings` table.

When maintenance mode is enabled:

- anonymous visitors receive the `503` page;
- authenticated users keep accessing routes protected by the middleware;
- the admin panel remains available;
- the configured message is shown on the maintenance page;
- the header shortcut can be enabled or hidden from the settings screen.

## Middleware

The registered alias is:

```php
'site.available' => \App\Http\Middleware\EnsureSiteIsAvailable::class,
```

To protect public routes, apply the middleware to the web group in your project:

```php
use Illuminate\Support\Facades\Route;

Route::middleware('site.available')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/blog/{post}', [PostController::class, 'show'])->name('blog.show');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
});
```

Admin routes do not need this middleware.

## Settings

| Field | Purpose |
| --- | --- |
| Current status | Shows whether the site is online or in maintenance. |
| Enable/Disable Maintenance | Toggles the public lock with a DaisyUI confirmation modal. |
| Maintenance Message | Defines the text shown on the `503` page. |
| Header Shortcut | Shows or hides the quick button in the header and mobile menu. |
| Site Online Alert | Shows a temporary alert when maintenance is disabled. |
| Alert duration | Defines how many seconds the online alert remains visible. Use `0` to keep it always visible. |

## 503 Page

The view used is:

```text
resources/views/errors/503.blade.php
```

It reads the current maintenance message and uses the minimal layout:

```text
resources/views/errors/minimal.blade.php
```

## Notes

- The confirmation modal uses DaisyUI because this is a simple yes/no flow.
- The module depends only on Laravel, Eloquent, Livewire, and DaisyUI already present in the dashboard.
- The `projeto` version ships the core, while each application decides which public routes should be protected.
