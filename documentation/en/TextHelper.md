# TextHelper

Normalizes, limits, counts, sanitizes, pluralizes, and transforms text for consistent application data and interface output.

## When To Use

- Use TextHelper when strings from forms, imports, comments, or titles need to be cleaned before display, storage, or transformation.
- Limit, count, and cleanup methods remove HTML when it makes sense, preventing tags from being counted as real content.
- Name and pluralization methods can receive a locale so connectors and plural files follow the active language rules.
- slug() applies the special character map before Str::slug(), preserving meaning in titles with symbols such as &, $, @,

## Example

```php
TextHelper::slug('Ke$ha & AC/DC', '-', 'en-US');
```

**Output**

```
kesha-and-ac-dc
```

## Methods

### `limitByCharacters`

Limits text by character count after removing HTML tags.

**Parameters**

| Parameter | Description |
| --- | --- |
| `text` | Text that will be truncated. |
| `limit` | Maximum number of characters before the ellipsis. |

**Example**

```php
TextHelper::limitByCharacters('<p>Lorem ipsum dolor sit amet</p>', 10);
```

**Output**

```
Lorem ipsu...
```

### `limitByWords`

Limits text by word count after removing HTML tags.

**Parameters**

| Parameter | Description |
| --- | --- |
| `text` | Text that will be truncated. |
| `limit` | Maximum number of words before the ellipsis. |

**Example**

```php
TextHelper::limitByWords('<p>Lorem ipsum dolor sit amet</p>', 3);
```

**Output**

```
Lorem ipsum dolor...
```

### `countWords`

Counts words in text while ignoring HTML tags and preserving accented words.

**Parameters**

| Parameter | Description |
| --- | --- |
| `text` | Text whose words will be counted. |

**Example**

```php
TextHelper::countWords('<p>Hello beautiful world</p>');
```

**Output**

```
3
```

### `countCharacters`

Counts characters in text after removing HTML tags, with the option to ignore spaces and line breaks.

**Parameters**

| Parameter | Description |
| --- | --- |
| `text` | Text whose characters will be counted. |
| `ignoreSpaces` | Whether spaces, tabs, and line breaks should be ignored. |

**Example**

```php
TextHelper::countCharacters("Hello \n world", true);
```

**Output**

```
10
```

### `removePunctuation`

Removes punctuation marks from text.

**Parameters**

| Parameter | Description |
| --- | --- |
| `text` | Text whose punctuation will be removed. |

**Example**

```php
TextHelper::removePunctuation('Hello, world!');
```

**Output**

```
Hello world
```

### `stripHTML`

Removes HTML tags from a string.

**Parameters**

| Parameter | Description |
| --- | --- |
| `text` | Text whose tags will be removed. |

**Example**

```php
TextHelper::stripHTML('<p>Hello <strong>world</strong></p>');
```

**Output**

```
Hello world
```

### `cleanText`

Normalizes duplicate spaces, tabs, and line breaks in a string.

**Parameters**

| Parameter | Description |
| --- | --- |
| `text` | Text that will be cleaned. |

**Example**

```php
TextHelper::cleanText("  Hello \n\t world  ");
```

**Output**

```
Hello world
```

### `normalizeWhitespace`

Collapses any whitespace sequence into a single space and trims surrounding spaces.

**Parameters**

| Parameter | Description |
| --- | --- |
| `text` | Text whose spacing will be normalized. |

**Example**

```php
TextHelper::normalizeWhitespace("  Hello \n\t world  ");
```

**Output**

```
Hello world
```

### `removeLineBreaks`

Replaces line breaks with spaces.

**Parameters**

| Parameter | Description |
| --- | --- |
| `text` | Text whose line breaks will be removed. |

**Example**

```php
TextHelper::removeLineBreaks("Hello\nworld");
```

**Output**

```
Hello world
```

### `removeAccents`

Converts accented characters to ASCII.

**Parameters**

| Parameter | Description |
| --- | --- |
| `text` | Text whose accents will be removed. |

**Example**

```php
TextHelper::removeAccents('ação');
```

**Output**

```
acao
```

### `convertSpecialCharacters`

Replaces special characters with the helper fixed map.

**Parameters**

| Parameter | Description |
| --- | --- |
| `text` | Text whose special characters will be replaced. |

**Example**

```php
TextHelper::convertSpecialCharacters('Rock & Roll / 2026');
```

**Output**

```
Rock and Roll - 2026
```

### `slug`

Generates a URL-friendly slug, removing HTML and converting special characters before normalization.

**Parameters**

| Parameter | Description |
| --- | --- |
| `text` | Text that will be converted to a slug. |
| `separator` | Separator used between slug words. |
| `locale` | Locale used to choose transliteration. |

**Example**

```php
TextHelper::slug('Ke$ha & AC/DC', '-', 'en-US');
```

**Output**

```
kesha-and-ac-dc
```

### `excerpt`

Builds a clean text excerpt by removing HTML, normalizing spaces, and applying a character limit.

**Parameters**

| Parameter | Description |
| --- | --- |
| `text` | Text that will be summarized. |
| `limit` | Maximum number of characters before the ellipsis. |

**Example**

```php
TextHelper::excerpt('<p>Beautiful clean content</p>', 14);
```

**Output**

```
Beautiful clean...
```

### `capitalizeNames`

Capitalizes names while preserving lowercase connectors for the locale.

**Parameters**

| Parameter | Description |
| --- | --- |
| `name` | Name that will be capitalized. |
| `locale` | Locale used to resolve connectors. |

**Example**

```php
TextHelper::capitalizeNames('john doe', 'en-US');
```

**Output**

```
John Doe
```

### `sanitize`

Removes HTML, replaces line breaks with spaces, and normalizes duplicate spaces.

**Parameters**

| Parameter | Description |
| --- | --- |
| `text` | Text that will be sanitized. |

**Example**

```php
TextHelper::sanitize("<p>Hello</p>\n world");
```

**Output**

```
Hello world
```

### `normalizeNames`

Sanitizes and capitalizes a name in one call.

**Parameters**

| Parameter | Description |
| --- | --- |
| `text` | Name that will be normalized. |
| `locale` | Locale used to resolve lowercase connectors. |

**Example**

```php
TextHelper::normalizeNames('  john   doe  ', 'en-US');
```

**Output**

```
John Doe
```

### `firstName`

Returns the first name after sanitizing and capitalizing the full name.

**Parameters**

| Parameter | Description |
| --- | --- |
| `name` | Input full name. |
| `locale` | Locale used to normalize the name before extraction. |

**Example**

```php
TextHelper::firstName('john doe', 'en-US');
```

**Output**

```
John
```

### `initials`

Builds initials from a name, ignoring locale connectors when they exist.

**Parameters**

| Parameter | Description |
| --- | --- |
| `name` | Name used to generate initials. |
| `limit` | Maximum number of initials returned. |
| `locale` | Locale used to ignore connectors. |

**Example**

```php
TextHelper::initials('john doe', 2, 'en-US');
```

**Output**

```
JD
```

### `onlyNumbers`

Removes all non-numeric characters from a string.

**Parameters**

| Parameter | Description |
| --- | --- |
| `text` | Text that will be filtered. |

**Example**

```php
TextHelper::onlyNumbers('(61) 99999-0000');
```

**Output**

```
61999990000
```

### `emptyFallback`

Returns fallback text when the value is null or an empty string.

**Parameters**

| Parameter | Description |
| --- | --- |
| `value` | Value that would be displayed. |
| `fallback` | Text displayed when the value is empty. |

**Example**

```php
TextHelper::emptyFallback('', 'Unavailable');
```

**Output**

```
Unavailable
```

### `readingTime`

Estimates reading time in minutes based on word count.

**Parameters**

| Parameter | Description |
| --- | --- |
| `text` | Text whose words will be counted. |
| `wordsPerMinute` | Words per minute used in the calculation. |

**Example**

```php
TextHelper::readingTime(str_repeat('word ', 201), 200);
```

**Output**

```
2
```

### `booleanLabel`

Returns a localized label for a boolean value.

**Parameters**

| Parameter | Description |
| --- | --- |
| `value` | Boolean value that will be converted to text. |
| `locale` | Locale used to choose the label. |

**Example**

```php
TextHelper::booleanLabel(false, 'en-US');
```

**Output**

```
No
```

### `plural`

Pluralizes a word or translation key using locale rules when available.

**Parameters**

| Parameter | Description |
| --- | --- |
| `string` | Base word or key defined in lang/{locale}/plurals.php. |
| `count` | Number of items or array that will be counted automatically. |
| `locale` | Locale used to resolve pluralization. |

**Example**

```php
TextHelper::plural('comments', 2, 'en-US');
```

**Output**

```
comments
```
