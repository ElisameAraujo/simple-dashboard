# NumberHelper

Formata números para exibição localizada, incluindo compactação, moeda, área convertida e ordinais.

## Quando Usar

- Use NumberHelper quando números precisam ser exibidos para pessoas respeitando locale, moeda, unidade ou ordinal.
- O helper normaliza locales como pt-BR para pt_BR antes de formatar.
- areaFormat() recebe valores em metros quadrados e converte para pés quadrados quando o locale usa ft².
- priceFormat() usa NumberFormatter no estilo de moeda para lidar com valores monetários.

## Exemplo

```php
NumberHelper::areaFormat(82.5, 'en_US');
```

**Saída**

```
888.02 ft²
```

## Métodos

### `compactNumber`

Compacta números grandes com sufixos localizados.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `number` | Número que será compactado. |
| `locale` | Locale usado para escolher sufixos e separador decimal. |

**Exemplo**

```php
NumberHelper::compactNumber(12500, 'pt-BR');
```

**Saída**

```
12,5 mil
```

### `priceFormat`

Formata um valor monetário usando NumberFormatter no estilo de moeda.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `number` | Valor monetário que será formatado. |
| `locale` | Locale usado para formatar o valor. |
| `currency` | Código da moeda. Quando null, usa a moeda padrão do locale. |

**Exemplo**

```php
NumberHelper::priceFormat(1234.56, 'pt-BR');
```

**Saída**

```
R$ 1.234,56
```

### `areaFormat`

Formata uma área informada em metros quadrados e converte para a unidade esperada pelo locale.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `value` | Valor da área em metros quadrados. |
| `locale` | Locale usado para definir unidade e formato decimal. |

**Exemplo**

```php
NumberHelper::areaFormat(82.5, 'en_US');
```

**Saída**

```
888.02 ft²
```

### `ordinal`

Retorna um número ordinal, com suporte a masculino e feminino em português.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `number` | Número que será formatado como ordinal. |
| `locale` | Locale usado para definir a regra ordinal. |
| `gender` | Gênero usado apenas em português. Use m para masculino ou f para feminino. |

**Exemplo**

```php
NumberHelper::ordinal(1, 'pt-BR', 'f');
```

**Saída**

```
1ª
```
