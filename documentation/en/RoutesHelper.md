# RouteHelper

Imports route files organized in folders within routes/ and lists the application's registered routes.

## When To Use

- Use RouteHelper to keep routes/web.php compact when a project separates routes by areas such as demo, admin, auth, or web.
- importRoutesFromFolder() is the main flow. It loads the direct .php files inside the final folder provided.
- Folder imports are not recursive. To load routes/web/home/sections/*.php, pass web as rootFolder and ['home', 'sections'] as subfolders.
- Filenames are protected against invalid extensions and paths are validated to stay inside routes/.

## Example

```php
RouteHelper::importRoutesFromFolder('demo', 'helpers');
```

**Output**

```
Direct .php files from routes/demo/helpers loaded.
```

## Methods

### `importRouteFile`

Imports a single route file within routes/ or one of its subfolders.

**Parameters**

| Parameter | Description |
| --- | --- |
| `filename` | Route filename. Prefer passing it without .php; a single .php extension is also accepted. |
| `folders` | Folder or list of folders inside routes/ where the file is located. |

**Example**

```php
RouteHelper::importRouteFile('helper-routes', ['demo', 'helpers']);
```

**Output**

```
routes/demo/helpers/helper-routes.php loaded.
```

### `importRoutesFromFolder`

Imports all direct .php files inside a route folder, with support for subfolders and exclusions.

**Parameters**

| Parameter | Description |
| --- | --- |
| `rootFolder` | Root folder inside routes/. |
| `subfolders` | Subfolder or list of subfolders inside the root folder. |
| `except` | Filename or list of files that should be skipped while loading. |

**Example**

```php
RouteHelper::importRoutesFromFolder('demo', ['helpers'], 'legacy-routes');
```

**Output**

```
Direct .php files from routes/demo/helpers loaded, except legacy-routes.php.
```

### `listAllRoutes`

Returns a simple inventory of the registered routes, including URI, name, HTTP method, and action.

**Example**

```php
RouteHelper::listAllRoutes();
```

**Output**

```
[
    ['uri' => 'helpers', 'name' => 'helpers.index', 'method' => 'GET|HEAD', 'action' => 'App\Http\Controllers\Admin\HelpersController@index'],
]
```
