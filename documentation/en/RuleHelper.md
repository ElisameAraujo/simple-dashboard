# RuleHelper

Extracts values from textual validation rules so interface limits stay synchronized with validation.

## When To Use

- Use RuleHelper when the interface needs to display the same limit already defined in validation rules, such as maxlength, counters, and helper text.
- The helper only extracts textual rules in the rule:value format, such as max:120, min:3, size:10, or between:3,120.
- The rules source may be a direct array, an object with formRules(), a class with static formRules(), or a class with public RULES, FORM_RULES, or REGRAS constants.
- Complex Laravel validation rule objects are ignored. The goal is to read simple textual values, not interpret the full validation API.

## Example

```php
$rules = [
    'title' => ['required', 'string', 'max:120'],
];

RuleHelper::extractValue('title', 'max', $rules);
```

**Output**

```
120
```

## Methods

### `extractValue`

Returns the value of a textual rule applied to a specific field.

**Parameters**

| Parameter | Description |
| --- | --- |
| `field` | Field whose rules will be inspected. |
| `ruleName` | Rule name that should be extracted, without colon or value. |
| `rulesSource` | Rules array, object with formRules(), class with static formRules(), or class with a public rules constant. |

**Example**

```php
$rules = [
    'comment' => ['required', 'max:5000'],
];

RuleHelper::extractValue('comment', 'max', $rules);
```

**Output**

```
5000
```
