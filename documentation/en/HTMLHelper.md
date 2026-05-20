# HTMLHelper

The **HTMLHelper** generates fake HTML content for seeders, factories, demos, and development tests.

It uses Faker internally and exposes a fluent API, allowing you to chain multiple HTML blocks and finish with `generate()`.

> This helper is meant to create sample content. It is not an HTML sanitizer and should not be used to clean user input.

---

# Available Functions

## `make(): static`

Creates a new HTML builder instance.

### Example

```php
$html = HTMLHelper::make()
    ->heading()
    ->paragraphs(2)
    ->generate();
```

---

## `heading(int|string|null $level = 2): static`

Adds a heading with random title text.

### Example

```php
HTMLHelper::make()
    ->heading(1)
    ->generate();

// <h1>...</h1>
```

---

## `headingWithLink(int|string|null $level = 2): static`

Adds a heading containing a random link.

### Example

```php
HTMLHelper::make()
    ->headingWithLink(2)
    ->generate();

// <h2>...<a href="#">...</a>...</h2>
```

---

## `emptyParagraph(): static`

Adds an empty paragraph.

### Example

```php
HTMLHelper::make()
    ->emptyParagraph()
    ->generate();

// <p></p>
```

---

## `paragraphs(int $count = 1, bool $withRandomLinks = false): static`

Adds one or more paragraphs.

When `$withRandomLinks` is `true`, each generated paragraph receives a random link inside the text.

### Examples

```php
HTMLHelper::make()
    ->paragraphs(3)
    ->generate();
```

```php
HTMLHelper::make()
    ->paragraphs(2, true)
    ->generate();
```

---

## `unorderedList(int $count = 1): static`

Adds an unordered list with random words.

### Example

```php
HTMLHelper::make()
    ->unorderedList(4)
    ->generate();

// <ul><li>...</li>...</ul>
```

---

## `orderedList(int $count = 1): static`

Adds an ordered list with random words.

### Example

```php
HTMLHelper::make()
    ->orderedList(4)
    ->generate();

// <ol><li>...</li>...</ol>
```

---

## `image(?int $width = 640, ?int $height = 480): static`

Adds a fake image tag using Faker's image URL generator.

### Example

```php
HTMLHelper::make()
    ->image(800, 450)
    ->generate();

// <img src="..." alt="..." width="800" height="450">
```

---

## `link(): static`

Adds a random link.

### Example

```php
HTMLHelper::make()
    ->link()
    ->generate();

// <a href="...">...</a>
```

---

## `video(?string $provider = 'youtube', ?int $width = 640, ?int $height = 480): static`

Adds an embedded video iframe.

Supported providers:

- `youtube`
- `vimeo`

### Examples

```php
HTMLHelper::make()
    ->video('youtube')
    ->generate();
```

```php
HTMLHelper::make()
    ->video('vimeo', 800, 450)
    ->generate();
```

---

## `details(): static`

Adds a `details` block with a random summary and paragraph.

### Example

```php
HTMLHelper::make()
    ->details()
    ->generate();
```

---

## `code(?string $className = 'hljs'): static`

Adds a code block wrapped in `pre` and `code`.

### Example

```php
HTMLHelper::make()
    ->code()
    ->generate();

// <pre class="hljs"><code>...</code></pre>
```

---

## `blockquote(): static`

Adds a random blockquote.

### Example

```php
HTMLHelper::make()
    ->blockquote()
    ->generate();
```

---

## `hr(): static`

Adds a horizontal rule.

### Example

```php
HTMLHelper::make()
    ->hr()
    ->generate();

// <hr>
```

---

## `br(): static`

Adds a line break.

### Example

```php
HTMLHelper::make()
    ->br()
    ->generate();

// <br>
```

---

## `table(): static`

Adds a fake table with a header and two body rows.

### Example

```php
HTMLHelper::make()
    ->table()
    ->generate();
```

---

## `grid(array $cols = [1, 1, 1]): static`

Adds a basic grid structure with random content in each column.

### Example

```php
HTMLHelper::make()
    ->grid([1, 1, 1])
    ->generate();
```

---

## `generate(): string`

Returns the generated HTML string.

### Example

```php
$html = HTMLHelper::make()
    ->heading()
    ->paragraphs(2)
    ->unorderedList(3)
    ->generate();
```

