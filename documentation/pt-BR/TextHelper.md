# TextHelper

Normaliza, limita, conta, sanitiza, pluraliza e transforma textos para uso consistente na interface e nos dados da aplicação.

## Quando Usar

- Use TextHelper quando strings vindas de formulários, imports, comentários ou títulos precisam ser limpas antes de exibir, salvar ou transformar.
- Os métodos de limite, contagem e limpeza removem HTML quando isso faz sentido, evitando que tags sejam contadas como conteúdo real.
- Os métodos de nomes e pluralização podem receber locale para respeitar conectores em português e arquivos de tradução de plurais.
- slug() aplica o mapa de caracteres especiais antes do Str::slug(), preservando sentido em títulos com símbolos como &, $, @,

## Exemplo

```php
TextHelper::slug('Ke$ha & AC/DC', '-', 'en-US');
```

**Saída**

```
kesha-and-ac-dc
```

## Métodos

### `limitByCharacters`

Limita um texto pela quantidade de caracteres depois de remover tags HTML.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `text` | Texto que será truncado. |
| `limit` | Quantidade máxima de caracteres antes das reticências. |

**Exemplo**

```php
TextHelper::limitByCharacters('<p>Lorem ipsum dolor sit amet</p>', 10);
```

**Saída**

```
Lorem ipsu...
```

### `limitByWords`

Limita um texto pela quantidade de palavras depois de remover tags HTML.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `text` | Texto que será truncado. |
| `limit` | Quantidade máxima de palavras antes das reticências. |

**Exemplo**

```php
TextHelper::limitByWords('<p>Lorem ipsum dolor sit amet</p>', 3);
```

**Saída**

```
Lorem ipsum dolor...
```

### `countWords`

Conta palavras em um texto, ignorando tags HTML e preservando palavras com acentos.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `text` | Texto cujas palavras serão contadas. |

**Exemplo**

```php
TextHelper::countWords('<p>Olá ação coração</p>');
```

**Saída**

```
3
```

### `countCharacters`

Conta caracteres em um texto depois de remover tags HTML, com opção de ignorar espaços e quebras.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `text` | Texto cujos caracteres serão contados. |
| `ignoreSpaces` | Define se espaços, tabs e quebras de linha devem ser ignorados. |

**Exemplo**

```php
TextHelper::countCharacters("Olá \n mundo", true);
```

**Saída**

```
8
```

### `removePunctuation`

Remove sinais de pontuação do texto.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `text` | Texto cuja pontuação será removida. |

**Exemplo**

```php
TextHelper::removePunctuation('Olá, mundo!');
```

**Saída**

```
Olá mundo
```

### `stripHTML`

Remove tags HTML de uma string.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `text` | Texto que terá as tags removidas. |

**Exemplo**

```php
TextHelper::stripHTML('<p>Olá <strong>mundo</strong></p>');
```

**Saída**

```
Olá mundo
```

### `cleanText`

Normaliza espaços duplicados, tabs e quebras de linha em uma string.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `text` | Texto que será limpo. |

**Exemplo**

```php
TextHelper::cleanText("  Olá \n\t mundo  ");
```

**Saída**

```
Olá mundo
```

### `normalizeWhitespace`

Compacta qualquer sequência de espaços em branco para um único espaço e remove espaços nas bordas.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `text` | Texto cujo espaçamento será normalizado. |

**Exemplo**

```php
TextHelper::normalizeWhitespace("  Olá \n\t mundo  ");
```

**Saída**

```
Olá mundo
```

### `removeLineBreaks`

Substitui quebras de linha por espaços.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `text` | Texto cujas quebras de linha serão removidas. |

**Exemplo**

```php
TextHelper::removeLineBreaks("Olá\nmundo");
```

**Saída**

```
Olá mundo
```

### `removeAccents`

Converte caracteres acentuados para ASCII.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `text` | Texto cujos acentos serão removidos. |

**Exemplo**

```php
TextHelper::removeAccents('ação');
```

**Saída**

```
acao
```

### `convertSpecialCharacters`

Substitui caracteres especiais pelo mapa fixo do helper.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `text` | Texto que terá caracteres especiais substituídos. |

**Exemplo**

```php
TextHelper::convertSpecialCharacters('Rock & Roll / 2026');
```

**Saída**

```
Rock and Roll - 2026
```

### `slug`

Gera um slug amigável para URL, removendo HTML e convertendo caracteres especiais antes da normalização.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `text` | Texto que será convertido em slug. |
| `separator` | Separador usado entre as palavras do slug. |
| `locale` | Locale usado para escolher a transliteração. |

**Exemplo**

```php
TextHelper::slug('Ke$ha & AC/DC', '-', 'en-US');
```

**Saída**

```
kesha-and-ac-dc
```

### `excerpt`

Cria um resumo limpo de texto, removendo HTML, normalizando espaços e aplicando limite de caracteres.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `text` | Texto que será resumido. |
| `limit` | Quantidade máxima de caracteres antes das reticências. |

**Exemplo**

```php
TextHelper::excerpt('<p>Ação coração brasileira</p>', 12);
```

**Saída**

```
Ação coração...
```

### `capitalizeNames`

Capitaliza nomes preservando conectores em minúsculo de acordo com o locale.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `name` | Nome que será capitalizado. |
| `locale` | Locale usado para resolver conectores como da, de, do, das, dos e e. |

**Exemplo**

```php
TextHelper::capitalizeNames('maria da silva e souza', 'pt-BR');
```

**Saída**

```
Maria da Silva e Souza
```

### `sanitize`

Remove HTML, troca quebras de linha por espaços e normaliza espaços duplicados.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `text` | Texto que será sanitizado. |

**Exemplo**

```php
TextHelper::sanitize("<p>Olá</p>\n mundo");
```

**Saída**

```
Olá mundo
```

### `normalizeNames`

Sanitiza e capitaliza um nome em uma única chamada.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `text` | Nome que será normalizado. |
| `locale` | Locale usado para resolver conectores em minúsculo. |

**Exemplo**

```php
TextHelper::normalizeNames('  maria   da silva  ', 'pt-BR');
```

**Saída**

```
Maria da Silva
```

### `firstName`

Retorna o primeiro nome depois de sanitizar e capitalizar o nome completo.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `name` | Nome completo de entrada. |
| `locale` | Locale usado para normalizar o nome antes da extração. |

**Exemplo**

```php
TextHelper::firstName('maria da silva', 'pt-BR');
```

**Saída**

```
Maria
```

### `initials`

Gera iniciais de um nome, ignorando conectores do locale quando existirem.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `name` | Nome usado para gerar as iniciais. |
| `limit` | Quantidade máxima de iniciais retornadas. |
| `locale` | Locale usado para ignorar conectores como da, de, do, das, dos e e. |

**Exemplo**

```php
TextHelper::initials('maria da silva', 2, 'pt-BR');
```

**Saída**

```
MS
```

### `onlyNumbers`

Remove todos os caracteres não numéricos de uma string.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `text` | Texto que será filtrado. |

**Exemplo**

```php
TextHelper::onlyNumbers('(61) 99999-0000');
```

**Saída**

```
61999990000
```

### `emptyFallback`

Retorna um fallback quando o valor é null ou uma string vazia.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `value` | Valor que seria exibido. |
| `fallback` | Texto exibido quando o valor está vazio. |

**Exemplo**

```php
TextHelper::emptyFallback('', 'Indisponível');
```

**Saída**

```
Indisponível
```

### `readingTime`

Estima o tempo de leitura em minutos com base na quantidade de palavras.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `text` | Texto que terá as palavras contadas. |
| `wordsPerMinute` | Quantidade de palavras por minuto usada no cálculo. |

**Exemplo**

```php
TextHelper::readingTime(str_repeat('palavra ', 201), 200);
```

**Saída**

```
2
```

### `booleanLabel`

Retorna um rótulo localizado para um valor booleano.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `value` | Valor booleano que será convertido em texto. |
| `locale` | Locale usado para escolher o rótulo. |

**Exemplo**

```php
TextHelper::booleanLabel(false, 'pt-BR');
```

**Saída**

```
Não
```

### `plural`

Pluraliza uma palavra ou chave de tradução usando as regras do locale quando existirem.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `string` | Palavra base ou chave definida em lang/{locale}/plurals.php. |
| `count` | Número de itens ou array que será contado automaticamente. |
| `locale` | Locale usado para resolver a pluralização. |

**Exemplo**

```php
TextHelper::plural('comments', 2, 'pt-BR');
```

**Saída**

```
comentários
```
