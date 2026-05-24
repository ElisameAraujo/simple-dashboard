# HTMLHelper

Monta blocos HTML fictícios para demos, previews de editor e placeholders de conteúdo.

## Quando Usar

- Use HTMLHelper quando precisar preencher uma página com marcação HTML falsa, mas estruturalmente parecida com conteúdo real.
- O helper começa com make(), encadeia métodos construtores como heading(), paragraphs(), listas, imagens, vídeos, tabelas e grids, e finaliza com generate().
- Os textos, links, imagens e vídeos são gerados com Faker, então o conteúdo muda a cada execução, mas a estrutura HTML permanece previsível.

## Exemplo

```php
echo HTMLHelper::make()
    ->heading(2)
    ->paragraphs(1)
    ->generate();
```

**Saída**

```
<h2>Título de Exemplo</h2><p>Parágrafo fictício gerado para visualização.</p>
```

## Métodos

### `make`

Inicia uma nova cadeia fluente do gerador HTML.

**Exemplo**

```php
HTMLHelper::make()
    ->heading(2)
    ->generate();
```

**Saída**

```
<h2>Título de Exemplo</h2>
```

### `heading`

Adiciona uma tag heading com texto fictício em formato de título.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `level` | Nível da heading entre 1 e 6. Valores inválidos, vazios ou fora desse intervalo usam 2. |

**Exemplo**

```php
HTMLHelper::make()->heading(2)->generate();
```

**Saída**

```
<h2>Título de Exemplo</h2>
```

### `headingWithLink`

Adiciona uma heading com texto fictício e um link no meio do conteúdo.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `level` | Nível da heading entre 1 e 6. Valores inválidos, vazios ou fora desse intervalo usam 2. |

**Exemplo**

```php
HTMLHelper::make()->headingWithLink(2)->generate();
```

**Saída**

```
<h2>Título Gerado <a href="#">Link de Exemplo</a> Texto Final</h2>
```

### `emptyParagraph`

Adiciona um parágrafo vazio, útil para testar espaçamentos e estados sem conteúdo.

**Exemplo**

```php
HTMLHelper::make()->emptyParagraph()->generate();
```

**Saída**

```
<p></p>
```

### `paragraphs`

Adiciona um ou mais parágrafos fictícios, com opção de inserir links aleatórios dentro do texto.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `count` | Quantidade de parágrafos que serão gerados. Valores menores que 1 usam 1. |
| `withRandomLinks` | Quando true, cada parágrafo recebe um link fictício em uma posição aleatória. |

**Exemplo**

```php
HTMLHelper::make()->paragraphs(1, true)->generate();
```

**Saída**

```
<p>Texto fictício com <a href="https://example.com">Link Gerado</a> dentro do parágrafo.</p>
```

### `unorderedList`

Adiciona uma lista não ordenada com itens fictícios.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `count` | Quantidade de itens que serão gerados. Valores menores que 1 usam 1. |

**Exemplo**

```php
HTMLHelper::make()->unorderedList(3)->generate();
```

**Saída**

```
<ul><li>primeiro</li><li>segundo</li><li>terceiro</li></ul>
```

### `orderedList`

Adiciona uma lista ordenada com itens fictícios.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `count` | Quantidade de itens que serão gerados. Valores menores que 1 usam 1. |

**Exemplo**

```php
HTMLHelper::make()->orderedList(3)->generate();
```

**Saída**

```
<ol><li>primeiro</li><li>segundo</li><li>terceiro</li></ol>
```

### `image`

Adiciona uma imagem fictícia com src, alt, width e height.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `width` | Largura aplicada no URL da imagem e no atributo width. Valores inválidos usam 640. |
| `height` | Altura aplicada no URL da imagem e no atributo height. Valores inválidos usam 480. |

**Exemplo**

```php
HTMLHelper::make()->image(640, 480)->generate();
```

**Saída**

```
<img src="https://via.placeholder.com/640x480.png/00aa33?text=demo" alt="Texto alternativo gerado." width="640" height="480">
```

### `link`

Adiciona um link fictício com URL e texto gerados.

**Exemplo**

```php
HTMLHelper::make()->link()->generate();
```

**Saída**

```
<a href="https://example.com">Link de exemplo</a>
```

### `video`

Adiciona um iframe de vídeo fictício para YouTube ou Vimeo.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `provider` | Provedor usado no embed. Aceita youtube ou vimeo; outros valores usam youtube. |
| `width` | Largura aplicada no iframe. Valores inválidos usam 640. |
| `height` | Altura aplicada no iframe. Valores inválidos usam 480. |

**Exemplo**

```php
HTMLHelper::make()->video('youtube', 640, 480)->generate();
```

**Saída**

```
<iframe width="640" height="480" src="https://www.youtube.com/embed/abc123def45" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
```

### `details`

Adiciona um bloco details com summary e conteúdo fictício.

**Exemplo**

```php
HTMLHelper::make()->details()->generate();
```

**Saída**

```
<details><summary>Pergunta gerada?</summary><div>Conteúdo detalhado gerado para teste.</div></details>
```

### `code`

Adiciona um bloco pre/code com uma classe CSS opcional.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `className` | Classe CSS aplicada ao elemento pre. Valores vazios usam hljs. |

**Exemplo**

```php
HTMLHelper::make()->code('hljs')->generate();
```

**Saída**

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

Adiciona uma citação fictícia.

**Exemplo**

```php
HTMLHelper::make()->blockquote()->generate();
```

**Saída**

```
<blockquote>Citação fictícia gerada.</blockquote>
```

### `hr`

Adiciona uma linha horizontal.

**Exemplo**

```php
HTMLHelper::make()->hr()->generate();
```

**Saída**

```
<hr>
```

### `br`

Adiciona uma quebra de linha.

**Exemplo**

```php
HTMLHelper::make()->br()->generate();
```

**Saída**

```
<br>
```

### `table`

Adiciona uma tabela fictícia com cabeçalho e duas linhas de conteúdo.

**Exemplo**

```php
HTMLHelper::make()->table()->generate();
```

**Saída**

```
<table><thead><tr><th>Nome</th><th>Status</th><th>Categoria</th></tr></thead><tbody><tr><td>Demo</td><td>Ativo</td><td>Blog</td></tr><tr><td>Preview</td><td>Rascunho</td><td>Produto</td></tr></tbody></table>
```

### `grid`

Adiciona um grid responsivo em que cada item usa o span definido no array de colunas.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `cols` | Array de spans para os itens do grid. Por exemplo, [1, 2, 1] cria três itens distribuídos em quatro colunas. |

**Exemplo**

```php
HTMLHelper::make()->grid([1, 2, 1])->generate();
```

**Saída**

```
<div class="grid" data-type="responsive" data-cols="4" style="grid-template-columns: repeat(4, 1fr);" data-stack-at="md"><div class="grid__column" data-col-span="1" style="grid-column: span 1;">...</div><div class="grid__column" data-col-span="2" style="grid-column: span 2;">...</div><div class="grid__column" data-col-span="1" style="grid-column: span 1;">...</div></div>
```

### `generate`

Retorna todo o HTML acumulado na cadeia de métodos.

**Exemplo**

```php
HTMLHelper::make()->heading(2)->generate();
```

**Saída**

```
<h2>Título de Exemplo</h2>
```
