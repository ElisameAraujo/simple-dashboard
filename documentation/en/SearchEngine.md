# Search Engine

Configurable search engine for the admin Spotlight, web search, and Livewire tables.

## When To Use

- Use Search Engine when search rules should live in `config/search.php`.
- Use it in the admin Spotlight to find menus, internal pages, and model records.
- Use it on the public site to build search dropdowns and result pages.
- Use it in Livewire tables to replace repeated manual search queries.

## How It Works

The module returns a collection of `SearchResult`.

The UI decides how to display results. The configuration decides which sources exist, which fields are searchable, which groups appear, and which actions may be shown.

```php
use App\Search\SearchEngine;

$results = app(SearchEngine::class)
    ->scope('admin')
    ->search('product');
```

## Main Files

| File | Purpose |
| --- | --- |
| `config/search.php` | Defines scopes, sources, groups, models, actions, and Livewire tables. |
| `app/Search/SearchEngine.php` | Module entry point. |
| `app/Search/SearchScope.php` | Runs static and model searches. |
| `app/Search/SearchLivewireTable.php` | Applies text search to a Livewire table Eloquent query. |
| `app/Search/SearchResult.php` | Object returned by the search. |
| `app/Livewire/Admin/Search/SearchSpotlight.php` | Admin Spotlight ready to consume the `admin` scope. |

## Base Structure

```php
return [
    'defaults' => [
        'min_chars' => 2,
        'limit' => 12,
        'model_field_weight' => 50,
        'static_field_weights' => [
            'title' => 100,
            'summary' => 45,
            'group' => 30,
            'badge' => 25,
            'keywords' => 80,
        ],
    ],

    'scopes' => [
        'admin' => [
            'groups' => [],
            'statics' => [],
            'models' => [],
            'actions' => [],
        ],

        'web' => [
            'groups' => [],
            'models' => [],
        ],
    ],

    'livewire_tables' => [],
];
```

## Groups

Groups segment results and feed the Spotlight filters.

```php
'groups' => [
    'settings' => [
        'label' => 'Settings',
        'icon' => 'fa-solid fa-gear',
        'order' => 10,
    ],
    'posts' => [
        'label_key' => 'search.groups.posts',
        'icon' => 'fa-solid fa-newspaper',
        'order' => 20,
    ],
],
```

## Static Items

Static items are ideal for menus, internal pages, and shortcuts that do not depend on the database.

```php
'statics' => [
    'maintenance' => [
        'title' => 'Maintenance',
        'summary' => 'Control the public availability of the site.',
        'group' => 'settings',
        'route' => 'admin.configs.maintenance',
        'icon' => 'fa-solid fa-wrench',
        'keywords' => ['site offline', 'maintenance', 'online'],
        'weight' => 100,
    ],
],
```

Use `title_key`, `summary_key`, and `keywords_key` if you want translated content.

## Eloquent Sources

Models add real records to the search.

```php
use App\Models\Post;

'models' => [
    'posts' => [
        'model' => Post::class,
        'group' => 'posts',
        'title_field' => 'title',
        'summary_field' => 'excerpt',
        'image_field' => 'cover_image',
        'badge' => 'Post',
        'select_fields' => ['id', 'title', 'slug', 'excerpt', 'cover_image', 'status'],
        'searchable_fields' => ['title', 'excerpt'],
        'fields_weight' => [
            'title' => 100,
            'excerpt' => 35,
        ],
        'constraints' => [
            ['field' => 'status', 'operator' => '=', 'value' => 'published'],
        ],
        'route' => 'blog.show',
        'route_fields' => [
            'post' => 'slug',
        ],
        'suggestions' => false,
        'candidate_limit' => 50,
        'order_by' => [
            'created_at' => 'desc',
        ],
    ],
],
```

## Fields And Weights

| Field | Purpose |
| --- | --- |
| `select_fields` | Defines which fields the query loads to build the result. |
| `searchable_fields` | Defines where the term will be searched. |
| `fields_weight` | Defines the relevance of each searchable field. |

`fields_weight` is optional. If omitted, every field in `searchable_fields` receives the default weight.

If a weight points to a field that does not exist in `searchable_fields`, execution stops with an exception.

## Model Actions

Actions live outside `models` to keep data sources separate from UI actions.

```php
'actions' => [
    'posts' => [
        'show' => true,
        'click' => 'edit',
        'items' => [
            'edit' => [
                'label' => 'Edit',
                'icon' => 'fa-solid fa-pen',
                'route' => [
                    'name' => 'admin.posts.edit',
                    'parameters' => [
                        'post' => 'id',
                    ],
                ],
            ],
            'visit' => [
                'label' => 'Visit',
                'icon' => 'fa-solid fa-arrow-up-right-from-square',
                'route' => [
                    'name' => 'blog.show',
                    'parameters' => [
                        'post' => 'slug',
                    ],
                ],
                'visible_when' => [
                    ['field' => 'status', 'operator' => '=', 'value' => 'published'],
                ],
            ],
        ],
    ],
],
```

If `click` is `edit` or `visit`, the whole card becomes that action and the matching button is not duplicated.

## Admin Spotlight

The admin layout already loads:

```blade
@livewire('admin.search.search-spotlight')
```

The menu button dispatches:

```html
x-on:click="$dispatch('toggle-spotlight')"
```

`Ctrl + K` or `Cmd + K` also opens the Spotlight.

## Web Search

The `web` scope does not ship with a public page in this project version.

To implement one:

```php
Route::get('/search', SearchController::class)->name('search');
```

```php
use App\Search\SearchEngine;

public function __invoke(Request $request)
{
    $results = app(SearchEngine::class)
        ->scope('web')
        ->search($request->string('q'));

    return view('web.search', compact('results'));
}
```

Use `constraints` to return only public content.

## Livewire Tables

Configure the table:

```php
use App\Models\Product;

'livewire_tables' => [
    'products' => [
        'model' => Product::class,
        'searchable_fields' => ['name', 'description'],
        'fields_weight' => [
            'name' => 100,
            'description' => 35,
        ],
        'term_mode' => 'all',
        'match_mode' => 'partial',
        'relevance_order' => true,
    ],
],
```

Consume it inside the Livewire component:

```php
use App\Search\SearchEngine;

$query = Product::query();

app(SearchEngine::class)
    ->livewireTable('products')
    ->apply($query, $this->search);

$products = $query->paginate(10);
```

The table remains responsible for filters, ordering, pagination, and business rules. Search Engine only applies text search.

## Validation

Before returning results, the module validates the full key that will be executed.

It stops execution when it finds:

- missing scope;
- invalid group;
- missing route;
- model that is not Eloquent;
- missing table or column;
- `fields_weight` pointing to a non-searchable field;
- action pointing to an invalid model or route;
- Livewire query using a different model than the configured one.

## Notes

- This `projeto` version ships the core and Spotlight, but does not create fake data, factories, or public example pages.
- The `wire-elements/spotlight` package is not used by this custom Search Engine.
- For public results, protect searches with constraints such as published status, public visibility, or publication date.
