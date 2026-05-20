# RuleHelper

The **RuleHelper** extracts values from Laravel validation rules.

It is useful when you want to reuse validation limits in the interface, such as showing a maximum number of characters based on a `max:5000` rule.

---

# Available Functions

## `extractValue(string $field, string $ruleName, string|array $rulesSource): ?string`

Extracts the value from a validation rule written as `rule:value`.

The rule source can be:

- an array of validation rules;
- a class name that exposes a static `formRules()` method.

If the field or rule is not found, the method returns `null`.

### Example with an array

```php
$rules = [
    'comment' => ['required', 'string', 'max:5000'],
];

RuleHelper::extractValue('comment', 'max', $rules);
// "5000"
```

### Example with pipe syntax

```php
$rules = [
    'title' => 'required|string|max:120',
];

RuleHelper::extractValue('title', 'max', $rules);
// "120"
```

### Example with a class

```php
class CreatePostData
{
    public static function formRules(): array
    {
        return [
            'title' => ['required', 'string', 'max:120'],
        ];
    }
}

RuleHelper::extractValue('title', 'max', CreatePostData::class);
// "120"
```

---

# Common Use Case

```blade
@php
    $maxLength = RuleHelper::extractValue('description', 'max', $this->formRules());
@endphp

<textarea maxlength="{{ $maxLength }}"></textarea>
```

---

# Notes

- Only string rules in the `rule:value` format can be extracted.
- Object-based rules, such as `Rule::unique(...)`, are ignored.
- The return value is a string because validation rule values are extracted from the original rule text.

