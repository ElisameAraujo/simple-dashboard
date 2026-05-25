# Visits

Standalone Eloquent visit tracking for any model that needs popularity metrics.

## When To Use

- Use Visits when a model needs page-view style metrics without depending on an external package.
- Use it for posts, products, pages, banners, or any model that should be ranked by popularity.
- The module records unique visits per visitor identity and interval. It is not a raw event stream for every refresh.

## How It Works

Visits stores one row per unique combination of:

```text
visitable_type
visitable_id
visitor_type
visitor_hash
interval
interval_key
```

The visitor value is hashed with `config('app.key')`, so raw IP, session id, user identity, or UUID values are not stored directly.

## Setup

Add the contract and trait to a model:

```php
use App\Visits\Contracts\CanBeVisited;
use App\Visits\Traits\HasVisits;

class Post extends Model implements CanBeVisited
{
    use HasVisits;
}
```

Run the migration:

```bash
php artisan migrate
```

## Recording Visits

```php
$post->visit()->withIp()->dailyInterval();
$post->visit()->withSession()->hourlyInterval();
$post->visit()->withUser()->dailyInterval();
$post->visit()->withUuid($visitorUuid)->monthlyInterval();
$post->visit()->withData(['source' => 'homepage'])->dailyInterval();
```

## Popularity Methods

| Method | Description |
| --- | --- |
| `visit()` | Starts the fluent recorder for the current model instance. |
| `withTotalVisitCount()` | Adds the `visit_count_total` attribute without changing the current ordering. |
| `popularAllTime()` | Orders models by their total number of visits. |
| `popularToday()` | Orders models by visits recorded between the start and end of the current day. |
| `popularThisWeek()` | Orders models by visits recorded during the current week. |
| `popularLastWeek()` | Orders models by visits recorded during the previous calendar week. |
| `popularThisMonth()` | Orders models by visits recorded during the current month. |
| `popularLastMonth()` | Orders models by visits recorded during the previous calendar month. |
| `popularThisYear()` | Orders models by visits recorded during the current year. |
| `popularLastYear()` | Orders models by visits recorded during the previous calendar year. |
| `popularLastDays($days)` | Orders models by visits recorded in the last number of days. |
| `popularBetween($from, $to)` | Orders models by visits recorded inside a custom date range. |

## Examples

```php
Post::query()
    ->popularThisMonth()
    ->limit(10)
    ->get();
```

```php
Post::query()
    ->withTotalVisitCount()
    ->orderByDesc('visit_count_total')
    ->paginate();
```

```php
Post::query()
    ->popularBetween(now()->subDays(30), now())
    ->get();
```

## Notes

- The `visits.user_id` foreign key assumes the default `users` table. If the project does not use it, adjust the migration before running it.
- The module depends only on Laravel, Eloquent, migrations, and Carbon through the application itself.
- Fake visit data belongs in local tests or seeders, not in the module core.
