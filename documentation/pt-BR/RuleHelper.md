# RuleHelper

O **RuleHelper** extrai valores de regras de validação do Laravel.

Ele é útil quando você quer reutilizar limites de validação na interface, como exibir a quantidade máxima de caracteres com base em uma regra `max:5000`.

---

# Funções disponíveis

## `extractValue(string $field, string $ruleName, string|array $rulesSource): ?string`

Extrai o valor de uma regra de validação escrita no formato `rule:value`.

A origem das regras pode ser:

- um array de regras de validação;
- o nome de uma classe que expõe um método estático `formRules()`.

Se o campo ou a regra não forem encontrados, o método retorna `null`.

### Exemplo com array

```php
$rules = [
    'comment' => ['required', 'string', 'max:5000'],
];

RuleHelper::extractValue('comment', 'max', $rules);
// "5000"
```

### Exemplo com sintaxe por pipe

```php
$rules = [
    'title' => 'required|string|max:120',
];

RuleHelper::extractValue('title', 'max', $rules);
// "120"
```

### Exemplo com classe

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

# Caso de uso comum

```blade
@php
    $maxLength = RuleHelper::extractValue('description', 'max', $this->formRules());
@endphp

<textarea maxlength="{{ $maxLength }}"></textarea>
```

---

# Observações

- Apenas regras em string no formato `rule:value` podem ser extraídas.
- Regras baseadas em objetos, como `Rule::unique(...)`, são ignoradas.
- O valor retornado é uma string porque ele é extraído do texto original da regra.

