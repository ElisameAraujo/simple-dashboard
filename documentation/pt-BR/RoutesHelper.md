# RouteHelper

Importa arquivos de rotas organizados em pastas dentro de routes/ e lista as rotas registradas da aplicação.

## Quando Usar

- Use RouteHelper para manter routes/web.php enxuto quando o projeto separa rotas por áreas como demo, admin, auth ou web.
- importRoutesFromFolder() é o fluxo principal. Ele carrega os arquivos .php diretamente dentro da pasta final informada.
- O import por pasta não é recursivo. Para carregar routes/web/home/secoes/*.php, informe web como rootFolder e ['home', 'secoes'] como subfolders.
- Os nomes de arquivo são protegidos contra extensões inválidas e os caminhos são validados para permanecer dentro de routes/.

## Exemplo

```php
RouteHelper::importRoutesFromFolder('demo', 'helpers');
```

**Saída**

```
Arquivos .php diretos de routes/demo/helpers carregados.
```

## Métodos

### `importRouteFile`

Importa um único arquivo de rota dentro de routes/ ou de uma subpasta.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `filename` | Nome do arquivo de rota. Prefira informar sem .php; uma única extensão .php também é aceita. |
| `folders` | Pasta ou lista de pastas dentro de routes/ onde o arquivo está localizado. |

**Exemplo**

```php
RouteHelper::importRouteFile('helper-routes', ['demo', 'helpers']);
```

**Saída**

```
routes/demo/helpers/helper-routes.php carregado.
```

### `importRoutesFromFolder`

Importa todos os arquivos .php diretamente dentro de uma pasta de rotas, com suporte a subpastas e exclusões.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `rootFolder` | Pasta principal dentro de routes/. |
| `subfolders` | Subpasta ou lista de subpastas dentro da pasta principal. |
| `except` | Nome ou lista de arquivos que devem ser ignorados no carregamento. |

**Exemplo**

```php
RouteHelper::importRoutesFromFolder('demo', ['helpers'], 'legacy-routes');
```

**Saída**

```
Arquivos .php diretos de routes/demo/helpers carregados, exceto legacy-routes.php.
```

### `listAllRoutes`

Retorna um inventário simples das rotas registradas, incluindo URI, nome, método HTTP e action.

**Exemplo**

```php
RouteHelper::listAllRoutes();
```

**Saída**

```
[
    ['uri' => 'helpers', 'name' => 'helpers.index', 'method' => 'GET|HEAD', 'action' => 'App\Http\Controllers\Admin\HelpersController@index'],
]
```
