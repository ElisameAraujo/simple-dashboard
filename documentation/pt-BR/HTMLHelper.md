# HTMLHelper

O **HTMLHelper** gera conteúdo HTML falso para seeders, factories, demos e testes durante o desenvolvimento.

Ele usa Faker internamente e expõe uma API fluente, permitindo encadear vários blocos HTML e finalizar com `generate()`.

> Este helper serve para criar conteúdo de exemplo. Ele não é um sanitizador de HTML e não deve ser usado para limpar entradas de usuários.

---

# Funções disponíveis

## `make(): static`

Cria uma nova instância do construtor de HTML.

### Exemplo

```php
$html = HTMLHelper::make()
    ->heading()
    ->paragraphs(2)
    ->generate();
```

---

## `heading(int|string|null $level = 2): static`

Adiciona um título com texto aleatório.

### Exemplo

```php
HTMLHelper::make()
    ->heading(1)
    ->generate();

// <h1>...</h1>
```

---

## `headingWithLink(int|string|null $level = 2): static`

Adiciona um título contendo um link aleatório.

### Exemplo

```php
HTMLHelper::make()
    ->headingWithLink(2)
    ->generate();

// <h2>...<a href="#">...</a>...</h2>
```

---

## `emptyParagraph(): static`

Adiciona um parágrafo vazio.

### Exemplo

```php
HTMLHelper::make()
    ->emptyParagraph()
    ->generate();

// <p></p>
```

---

## `paragraphs(int $count = 1, bool $withRandomLinks = false): static`

Adiciona um ou mais parágrafos.

Quando `$withRandomLinks` é `true`, cada parágrafo gerado recebe um link aleatório dentro do texto.

### Exemplos

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

Adiciona uma lista não ordenada com palavras aleatórias.

### Exemplo

```php
HTMLHelper::make()
    ->unorderedList(4)
    ->generate();

// <ul><li>...</li>...</ul>
```

---

## `orderedList(int $count = 1): static`

Adiciona uma lista ordenada com palavras aleatórias.

### Exemplo

```php
HTMLHelper::make()
    ->orderedList(4)
    ->generate();

// <ol><li>...</li>...</ol>
```

---

## `image(?int $width = 640, ?int $height = 480): static`

Adiciona uma tag de imagem falsa usando o gerador de URL de imagem do Faker.

### Exemplo

```php
HTMLHelper::make()
    ->image(800, 450)
    ->generate();

// <img src="..." alt="..." width="800" height="450">
```

---

## `link(): static`

Adiciona um link aleatório.

### Exemplo

```php
HTMLHelper::make()
    ->link()
    ->generate();

// <a href="...">...</a>
```

---

## `video(?string $provider = 'youtube', ?int $width = 640, ?int $height = 480): static`

Adiciona um iframe de vídeo.

Provedores suportados:

- `youtube`
- `vimeo`

### Exemplos

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

Adiciona um bloco `details` com resumo e parágrafo aleatórios.

### Exemplo

```php
HTMLHelper::make()
    ->details()
    ->generate();
```

---

## `code(?string $className = 'hljs'): static`

Adiciona um bloco de código dentro de `pre` e `code`.

### Exemplo

```php
HTMLHelper::make()
    ->code()
    ->generate();

// <pre class="hljs"><code>...</code></pre>
```

---

## `blockquote(): static`

Adiciona uma citação aleatória.

### Exemplo

```php
HTMLHelper::make()
    ->blockquote()
    ->generate();
```

---

## `hr(): static`

Adiciona uma linha horizontal.

### Exemplo

```php
HTMLHelper::make()
    ->hr()
    ->generate();

// <hr>
```

---

## `br(): static`

Adiciona uma quebra de linha.

### Exemplo

```php
HTMLHelper::make()
    ->br()
    ->generate();

// <br>
```

---

## `table(): static`

Adiciona uma tabela falsa com cabeçalho e duas linhas no corpo.

### Exemplo

```php
HTMLHelper::make()
    ->table()
    ->generate();
```

---

## `grid(array $cols = [1, 1, 1]): static`

Adiciona uma estrutura básica de grid com conteúdo aleatório em cada coluna.

### Exemplo

```php
HTMLHelper::make()
    ->grid([1, 1, 1])
    ->generate();
```

---

## `generate(): string`

Retorna a string HTML gerada.

### Exemplo

```php
$html = HTMLHelper::make()
    ->heading()
    ->paragraphs(2)
    ->unorderedList(3)
    ->generate();
```

