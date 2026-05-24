# NumberHelper

Formats numbers for localized display, including compaction, money, converted area, and ordinals.

## When To Use

- Use NumberHelper when numbers need to be displayed for humans with locale, currency, unit, or ordinal rules.
- The helper normalizes locales such as pt-BR to pt_BR before formatting.
- areaFormat() receives values in square meters and converts them to square feet when the locale uses ft².
- priceFormat() uses NumberFormatter with currency style to handle monetary values.

## Example

```php
NumberHelper::areaFormat(82.5, 'en_US');
```

**Output**

```
888.02 ft²
```

## Methods

### `compactNumber`

Compacts large numbers with localized suffixes.

**Parameters**

| Parameter | Description |
| --- | --- |
| `number` | Number that will be compacted. |
| `locale` | Locale used to choose suffixes and the decimal separator. |

**Example**

```php
NumberHelper::compactNumber(12500, 'en_US');
```

**Output**

```
12.5 K
```

### `priceFormat`

Formats a monetary value using NumberFormatter with currency style.

**Parameters**

| Parameter | Description |
| --- | --- |
| `number` | Monetary value that will be formatted. |
| `locale` | Locale used to format the value. |
| `currency` | Currency code. When null, the locale default currency is used. |

**Example**

```php
NumberHelper::priceFormat(1234.56, 'en_US');
```

**Output**

```
$1,234.56
```

### `areaFormat`

Formats an area provided in square meters and converts it to the unit expected by the locale.

**Parameters**

| Parameter | Description |
| --- | --- |
| `value` | Area value in square meters. |
| `locale` | Locale used to define the unit and decimal format. |

**Example**

```php
NumberHelper::areaFormat(82.5, 'en_US');
```

**Output**

```
888.02 ft²
```

### `ordinal`

Returns an ordinal number, with masculine and feminine support in Portuguese.

**Parameters**

| Parameter | Description |
| --- | --- |
| `number` | Number that will be formatted as an ordinal. |
| `locale` | Locale used to define the ordinal rule. |
| `gender` | Gender used only in Portuguese. Use m for masculine or f for feminine. |

**Example**

```php
NumberHelper::ordinal(22, 'en_US');
```

**Output**

```
22nd
```
