# Search Engine

Motor de busca configurável para Spotlight administrativo, pesquisa web e tabelas Livewire.

## Quando Usar

- Use Search Engine quando precisa centralizar regras de pesquisa em `config/search.php`.
- Use no Spotlight do painel para buscar menus, páginas internas e registros de models.
- Use no site público para montar dropdowns de busca e páginas de resultados.
- Use em tabelas Livewire para substituir queries manuais repetidas.

## Como Funciona

O módulo entrega uma coleção de `SearchResult`.

A interface decide como exibir os resultados. A configuração decide quais fontes existem, quais campos são pesquisáveis, quais grupos aparecem e quais ações podem ser exibidas.

```php
use App\Search\SearchEngine;

$results = app(SearchEngine::class)
    ->scope('admin')
    ->search('produto');
```

## Arquivos Principais

| Arquivo | Função |
| --- | --- |
| `config/search.php` | Define escopos, fontes, grupos, models, actions e tabelas Livewire. |
| `app/Search/SearchEngine.php` | Ponto de entrada do módulo. |
| `app/Search/SearchScope.php` | Executa a busca em fontes estáticas e models. |
| `app/Search/SearchLivewireTable.php` | Aplica a busca textual em uma query Eloquent de tabela Livewire. |
| `app/Search/SearchResult.php` | Objeto retornado pela busca. |
| `app/Livewire/Admin/Search/SearchSpotlight.php` | Spotlight administrativo pronto para consumir o escopo `admin`. |

## Estrutura Base

```php
return [
    'defaults' => [
        'min_chars' => 2,
        'limit' => 12,
        'model_field_weight' => 50,
        'static_field_weights' => [
            'title' => 100,
            'summary' => 45,
            'group' => 30,
            'badge' => 25,
            'keywords' => 80,
        ],
    ],

    'scopes' => [
        'admin' => [
            'groups' => [],
            'statics' => [],
            'models' => [],
            'actions' => [],
        ],

        'web' => [
            'groups' => [],
            'models' => [],
        ],
    ],

    'livewire_tables' => [],
];
```

## Grupos

Grupos segmentam os resultados e alimentam os filtros do Spotlight.

```php
'groups' => [
    'settings' => [
        'label' => 'Configurações',
        'icon' => 'fa-solid fa-gear',
        'order' => 10,
    ],
    'posts' => [
        'label_key' => 'search.groups.posts',
        'icon' => 'fa-solid fa-newspaper',
        'order' => 20,
    ],
],
```

## Itens Estáticos

Itens estáticos são ideais para menus, páginas internas e atalhos que não dependem do banco.

```php
'statics' => [
    'maintenance' => [
        'title' => 'Manutenção',
        'summary' => 'Controle a disponibilidade pública do site.',
        'group' => 'settings',
        'route' => 'admin.configs.maintenance',
        'icon' => 'fa-solid fa-wrench',
        'keywords' => ['site offline', 'manutenção', 'online'],
        'weight' => 100,
    ],
],
```

Use `title_key`, `summary_key` e `keywords_key` se quiser traduzir o conteúdo.

## Fontes Eloquent

Models adicionam registros reais à busca.

```php
use App\Models\Post;

'models' => [
    'posts' => [
        'model' => Post::class,
        'group' => 'posts',
        'title_field' => 'title',
        'summary_field' => 'excerpt',
        'image_field' => 'cover_image',
        'badge' => 'Post',
        'select_fields' => ['id', 'title', 'slug', 'excerpt', 'cover_image', 'status'],
        'searchable_fields' => ['title', 'excerpt'],
        'fields_weight' => [
            'title' => 100,
            'excerpt' => 35,
        ],
        'constraints' => [
            ['field' => 'status', 'operator' => '=', 'value' => 'published'],
        ],
        'route' => 'blog.show',
        'route_fields' => [
            'post' => 'slug',
        ],
        'suggestions' => false,
        'candidate_limit' => 50,
        'order_by' => [
            'created_at' => 'desc',
        ],
    ],
],
```

## Campos E Pesos

| Campo | Função |
| --- | --- |
| `select_fields` | Define quais campos a query carrega para montar o resultado. |
| `searchable_fields` | Define onde o termo será pesquisado. |
| `fields_weight` | Define a relevância de cada campo pesquisável. |

`fields_weight` é opcional. Se ele for omitido, todos os campos em `searchable_fields` recebem o peso padrão.

Se um peso apontar para um campo que não existe em `searchable_fields`, a execução é interrompida com exception.

## Actions De Models

Actions ficam fora de `models` para manter a fonte de dados separada das ações de interface.

```php
'actions' => [
    'posts' => [
        'show' => true,
        'click' => 'edit',
        'items' => [
            'edit' => [
                'label' => 'Editar',
                'icon' => 'fa-solid fa-pen',
                'route' => [
                    'name' => 'admin.posts.edit',
                    'parameters' => [
                        'post' => 'id',
                    ],
                ],
            ],
            'visit' => [
                'label' => 'Visitar',
                'icon' => 'fa-solid fa-arrow-up-right-from-square',
                'route' => [
                    'name' => 'blog.show',
                    'parameters' => [
                        'post' => 'slug',
                    ],
                ],
                'visible_when' => [
                    ['field' => 'status', 'operator' => '=', 'value' => 'published'],
                ],
            ],
        ],
    ],
],
```

Se `click` for `edit` ou `visit`, o card inteiro vira essa ação e o botão correspondente não é duplicado.

## Spotlight Administrativo

O layout administrativo já carrega:

```blade
@livewire('admin.search.search-spotlight')
```

O botão do menu dispara:

```html
x-on:click="$dispatch('toggle-spotlight')"
```

O atalho `Ctrl + K` ou `Cmd + K` também abre o Spotlight.

## Pesquisa Web

O escopo `web` não vem com uma página pública pronta nesta versão do projeto.

Para implementar:

```php
Route::get('/pesquisa', SearchController::class)->name('search');
```

```php
use App\Search\SearchEngine;

public function __invoke(Request $request)
{
    $results = app(SearchEngine::class)
        ->scope('web')
        ->search($request->string('q'));

    return view('web.search', compact('results'));
}
```

Use `constraints` para retornar apenas conteúdo público.

## Tabelas Livewire

Configure a tabela:

```php
use App\Models\Product;

'livewire_tables' => [
    'products' => [
        'model' => Product::class,
        'searchable_fields' => ['name', 'description'],
        'fields_weight' => [
            'name' => 100,
            'description' => 35,
        ],
        'term_mode' => 'all',
        'match_mode' => 'partial',
        'relevance_order' => true,
    ],
],
```

Consuma dentro do componente Livewire:

```php
use App\Search\SearchEngine;

$query = Product::query();

app(SearchEngine::class)
    ->livewireTable('products')
    ->apply($query, $this->search);

$products = $query->paginate(10);
```

A tabela continua responsável por filtros, ordenação, paginação e regras de negócio. O Search Engine só aplica a pesquisa textual.

## Validação

Antes de retornar resultados, o módulo valida a chave completa que será executada.

Ele interrompe a execução quando encontra:

- escopo inexistente;
- grupo inválido;
- rota inexistente;
- model que não é Eloquent;
- tabela ou coluna inexistente;
- `fields_weight` apontando para campo não pesquisável;
- action apontando para model ou rota inválida;
- query Livewire com model diferente do configurado.

## Observações

- Esta versão do `projeto` entrega o core e o Spotlight prontos, mas não cria dados fake, factories ou páginas web de exemplo.
- O pacote `wire-elements/spotlight` não é usado pelo Search Engine próprio.
- Para resultados públicos, proteja a busca com constraints como status publicado, visibilidade pública ou data de publicação.
