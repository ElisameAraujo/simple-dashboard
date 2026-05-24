# DateHelper

Formats dates, relative intervals, and email-friendly date labels with localized output.

## When To Use

- Use DateHelper when dates need to be displayed for people, not only stored or compared.
- The helper resolves the requested locale, loads the project date translations, and applies the application timezone before formatting.

## Example

```php
DateHelper::simpleDate('2026-05-19', 'en_US');
```

**Output**

```
05/19/2026
```

## Methods

### `currentYear`

Returns the current year as four digits.

**Example**

```php
DateHelper::currentYear();
```

**Output**

```
2026
```

### `currentDate`

Returns the current date using the format configured for the given locale.

**Parameters**

| Parameter | Description |
| --- | --- |
| `locale` | Locale used to define the output format. When omitted, the current application locale is used. |

**Example**

```php
DateHelper::currentDate('en_US');
```

**Output**

```
05/21/2026
```

### `fullCurrentDate`

Returns the current date in full, with translated weekday and month names.

**Parameters**

| Parameter | Description |
| --- | --- |
| `locale` | Locale used to translate the weekday, month, and final format. |

**Example**

```php
DateHelper::fullCurrentDate('en_US');
```

**Output**

```
Thursday, May 21, 2026
```

### `fullExtendedDate`

Formats a date string using the locale's full date format.

**Parameters**

| Parameter | Description |
| --- | --- |
| `date` | Date that will be formatted. |
| `locale` | Locale used to translate the weekday, month, and final format. |

**Example**

```php
DateHelper::fullExtendedDate('2026-05-19', 'en_US');
```

**Output**

```
Tuesday, May 19, 2026
```

### `currentFullDateWithHours`

Formats a date in full including the time.

**Parameters**

| Parameter | Description |
| --- | --- |
| `date` | Date and time that will be formatted. |
| `locale` | Locale used to translate and build the final output. |

**Example**

```php
DateHelper::currentFullDateWithHours('2026-05-19 10:30:00', 'en_US');
```

**Output**

```
May 19, 2026 at 10:30
```

### `diffDatesHuman`

Returns the difference between a date and the current moment in human-readable text.

**Parameters**

| Parameter | Description |
| --- | --- |
| `date` | Date that will be compared with the current moment. |
| `locale` | Locale used to translate units such as minutes, hours, days, and months. |

**Example**

```php
DateHelper::diffDatesHuman('2026-05-19 11:58:00', 'en_US');
```

**Output**

```
2 minutes ago
```

### `dateWithHoursAndSeconds`

Formats a date with hour, minute, and second.

**Parameters**

| Parameter | Description |
| --- | --- |
| `date` | Date and time that will be formatted. |
| `locale` | Locale used to define the output format. |

**Example**

```php
DateHelper::dateWithHoursAndSeconds('2026-05-19 10:30:15', 'en_US');
```

**Output**

```
05/19/2026 10:30:15
```

### `dateExcel`

Formats a date using the spreadsheet-friendly pattern for the given locale.

**Parameters**

| Parameter | Description |
| --- | --- |
| `date` | Date that will be formatted. |
| `locale` | Locale used to define the date pattern. |

**Example**

```php
DateHelper::dateExcel('2026-05-19', 'en_US');
```

**Output**

```
05/19/2026
```

### `dateWithHours`

Formats a date with hour and minute, without seconds.

**Parameters**

| Parameter | Description |
| --- | --- |
| `date` | Date and time that will be formatted. |
| `locale` | Locale used to define the output format. |

**Example**

```php
DateHelper::dateWithHours('2026-05-19 10:30:15', 'en_US');
```

**Output**

```
05/19/2026 10:30
```

### `simpleDate`

Formats a simple date with day, month, and year.

**Parameters**

| Parameter | Description |
| --- | --- |
| `date` | Date that will be formatted. |
| `locale` | Locale used to define the output format. |

**Example**

```php
DateHelper::simpleDate('2026-05-19', 'en_US');
```

**Output**

```
05/19/2026
```

### `isTodayCheck`

Checks whether the given date is today.

**Parameters**

| Parameter | Description |
| --- | --- |
| `date` | Date that will be compared with today. |

**Example**

```php
DateHelper::isTodayCheck('2026-05-21');
```

**Output**

```
true
```

### `daysDifference`

Returns the difference in days between two dates.

**Parameters**

| Parameter | Description |
| --- | --- |
| `startDate` | Start date used in the calculation. |
| `endDate` | End date used in the calculation. |

**Example**

```php
DateHelper::daysDifference('2026-05-19', '2026-05-22');
```

**Output**

```
3
```

### `shortDate`

Displays only the day and month using the locale's short format.

**Parameters**

| Parameter | Description |
| --- | --- |
| `date` | Date that will be formatted. |
| `locale` | Locale used to define the short format. |

**Example**

```php
DateHelper::shortDate('2026-05-19', 'en_US');
```

**Output**

```
May 19
```

### `shortTime`

Displays only hour and minute.

**Parameters**

| Parameter | Description |
| --- | --- |
| `date` | Date and time that will be formatted. |
| `locale` | Locale used to define the time format. |

**Example**

```php
DateHelper::shortTime('2026-05-19 10:30:15', 'en_US');
```

**Output**

```
10:30
```

### `emailDate`

Formats a date for email display by combining a short date and relative time.

**Parameters**

| Parameter | Description |
| --- | --- |
| `date` | Date and time that will be formatted. |
| `locale` | Locale used to translate the date and relative time. |

**Example**

```php
DateHelper::emailDate('2026-05-19 11:58:00', 'en_US');
```

**Output**

```
Tue, may. 19, 11:58 (2 minutes ago)
```
