# PaginationHelper

The **PaginationHelper** builds a compact list of page numbers for custom pagination views.

It is useful when you want to render the first pages, the last pages, and the pages around the current page without manually calculating those ranges inside a Blade view.

---

# Available Functions

## `build($paginator, $eachSide = null): array`

Returns a sorted array of page numbers that should be displayed.

The helper includes:

- the first pages;
- the last pages;
- the pages around the current page.

If `$eachSide` is not provided, the helper uses the paginator's own `onEachSide` value.

### Example

```php
$pages = PaginationHelper::build($posts);
```

### Example with a custom range

```php
$pages = PaginationHelper::build($posts, 2);
```

### Possible output

```php
[
    1,
    2,
    8,
    9,
    10,
    18,
    19,
]
```

---

# Blade Usage

```blade
@foreach (PaginationHelper::build($posts, 2) as $page)
    <a href="{{ $posts->url($page) }}">
        {{ $page }}
    </a>
@endforeach
```

---

# Notes

- The `$paginator` object must provide `currentPage()` and `lastPage()`.
- The helper only builds the page number list. It does not render HTML.
- Use Laravel's native paginator methods, such as `url($page)`, to generate the final links.

