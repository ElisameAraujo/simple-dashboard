# HTMLHelper

Builds fake HTML blocks for demos, editor previews, and content placeholders.

## When To Use

- Use HTMLHelper when you need to fill a page with fake HTML markup that still looks structurally close to real content.
- The helper starts with make(), chains builder methods such as heading(), paragraphs(), lists, images, videos, tables, and grids, then finishes with generate().
- Text, links, images, and videos are generated with Faker, so the content changes on each execution while the HTML structure stays predictable.

## Example

```php
echo HTMLHelper::make()
    ->heading(2)
    ->paragraphs(1)
    ->generate();
```

**Output**

```
<h2>Example Title</h2><p>Generated paragraph for preview.</p>
```

## Methods

### `make`

Starts a new fluent HTML generator chain.

**Example**

```php
HTMLHelper::make()
    ->heading(2)
    ->generate();
```

**Output**

```
<h2>Example Title</h2>
```

### `heading`

Adds a heading tag with generated title-style text.

**Parameters**

| Parameter | Description |
| --- | --- |
| `level` | Heading level between 1 and 6. Invalid, empty, or out-of-range values use 2. |

**Example**

```php
HTMLHelper::make()->heading(2)->generate();
```

**Output**

```
<h2>Example Title</h2>
```

### `headingWithLink`

Adds a heading with generated text and a link in the middle of the content.

**Parameters**

| Parameter | Description |
| --- | --- |
| `level` | Heading level between 1 and 6. Invalid, empty, or out-of-range values use 2. |

**Example**

```php
HTMLHelper::make()->headingWithLink(2)->generate();
```

**Output**

```
<h2>Generated Title <a href="#">Example Link</a> Final Text</h2>
```

### `emptyParagraph`

Adds an empty paragraph, useful for testing spacing and contentless states.

**Example**

```php
HTMLHelper::make()->emptyParagraph()->generate();
```

**Output**

```
<p></p>
```

### `paragraphs`

Adds one or more generated paragraphs, with an option to insert random links inside the text.

**Parameters**

| Parameter | Description |
| --- | --- |
| `count` | Number of paragraphs that will be generated. Values below 1 use 1. |
| `withRandomLinks` | When true, each paragraph receives a fake link at a random position. |

**Example**

```php
HTMLHelper::make()->paragraphs(1, true)->generate();
```

**Output**

```
<p>Generated text with <a href="https://example.com">Generated Link</a> inside the paragraph.</p>
```

### `unorderedList`

Adds an unordered list with generated items.

**Parameters**

| Parameter | Description |
| --- | --- |
| `count` | Number of items that will be generated. Values below 1 use 1. |

**Example**

```php
HTMLHelper::make()->unorderedList(3)->generate();
```

**Output**

```
<ul><li>first</li><li>second</li><li>third</li></ul>
```

### `orderedList`

Adds an ordered list with generated items.

**Parameters**

| Parameter | Description |
| --- | --- |
| `count` | Number of items that will be generated. Values below 1 use 1. |

**Example**

```php
HTMLHelper::make()->orderedList(3)->generate();
```

**Output**

```
<ol><li>first</li><li>second</li><li>third</li></ol>
```

### `image`

Adds a generated image with src, alt, width, and height.

**Parameters**

| Parameter | Description |
| --- | --- |
| `width` | Width applied to the image URL and width attribute. Invalid values use 640. |
| `height` | Height applied to the image URL and height attribute. Invalid values use 480. |

**Example**

```php
HTMLHelper::make()->image(640, 480)->generate();
```

**Output**

```
<img src="https://via.placeholder.com/640x480.png/00aa33?text=demo" alt="Generated alt text." width="640" height="480">
```

### `link`

Adds a generated link with a fake URL and text.

**Example**

```php
HTMLHelper::make()->link()->generate();
```

**Output**

```
<a href="https://example.com">Example link</a>
```

### `video`

Adds a generated video iframe for YouTube or Vimeo.

**Parameters**

| Parameter | Description |
| --- | --- |
| `provider` | Provider used in the embed. Accepts youtube or vimeo; other values use youtube. |
| `width` | Width applied to the iframe. Invalid values use 640. |
| `height` | Height applied to the iframe. Invalid values use 480. |

**Example**

```php
HTMLHelper::make()->video('youtube', 640, 480)->generate();
```

**Output**

```
<iframe width="640" height="480" src="https://www.youtube.com/embed/abc123def45" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
```

### `details`

Adds a details block with a summary and generated content.

**Example**

```php
HTMLHelper::make()->details()->generate();
```

**Output**

```
<details><summary>Generated question?</summary><div>Generated detail content for testing.</div></details>
```

### `code`

Adds a pre/code block with an optional CSS class.

**Parameters**

| Parameter | Description |
| --- | --- |
| `className` | CSS class applied to the pre element. Empty values use hljs. |

**Example**

```php
HTMLHelper::make()->code('hljs')->generate();
```

**Output**

```
<pre class="hljs"><code>export default function testComponent({

state,

}) {

return {

state,

init: function () {

// Initialise the Alpine component here, if you need to.

},

}

}</code></pre>
```

### `blockquote`

Adds a generated quote.

**Example**

```php
HTMLHelper::make()->blockquote()->generate();
```

**Output**

```
<blockquote>Generated quote.</blockquote>
```

### `hr`

Adds a horizontal rule.

**Example**

```php
HTMLHelper::make()->hr()->generate();
```

**Output**

```
<hr>
```

### `br`

Adds a line break.

**Example**

```php
HTMLHelper::make()->br()->generate();
```

**Output**

```
<br>
```

### `table`

Adds a generated table with a header and two content rows.

**Example**

```php
HTMLHelper::make()->table()->generate();
```

**Output**

```
<table><thead><tr><th>Name</th><th>Status</th><th>Category</th></tr></thead><tbody><tr><td>Demo</td><td>Active</td><td>Blog</td></tr><tr><td>Preview</td><td>Draft</td><td>Product</td></tr></tbody></table>
```

### `grid`

Adds a responsive grid where each item uses the span defined in the columns array.

**Parameters**

| Parameter | Description |
| --- | --- |
| `cols` | Array of spans for the grid items. For example, [1, 2, 1] creates three items distributed across four columns. |

**Example**

```php
HTMLHelper::make()->grid([1, 2, 1])->generate();
```

**Output**

```
<div class="grid" data-type="responsive" data-cols="4" style="grid-template-columns: repeat(4, 1fr);" data-stack-at="md"><div class="grid__column" data-col-span="1" style="grid-column: span 1;">...</div><div class="grid__column" data-col-span="2" style="grid-column: span 2;">...</div><div class="grid__column" data-col-span="1" style="grid-column: span 1;">...</div></div>
```

### `generate`

Returns all HTML accumulated in the method chain.

**Example**

```php
HTMLHelper::make()->heading(2)->generate();
```

**Output**

```
<h2>Example Title</h2>
```
