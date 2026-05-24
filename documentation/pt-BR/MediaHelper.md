# MediaHelper

Exibe, valida e entrega URLs ou respostas para mídias armazenadas nos discos do Laravel.

## Quando Usar

- Use MediaHelper quando uma view ou serviço recebe apenas o caminho salvo no banco e precisa transformá-lo em uma URL pública, placeholder, download ou informação de MIME type.
- O parâmetro disk aponta para um disco configurado em config/filesystems.php e, no uso comum da base, também representa a pasta pública usada na URL final.
- O parâmetro path deve ser relativo ao disco. Por exemplo, se o arquivo está no disco products como demo.jpg, showMedia('demo.jpg', 'products') retorna /storage/products/demo.jpg.

## Exemplo

```php
<img src="{{ MediaHelper::showMedia($product->product_image, 'products', 'img/placeholders/product-image-not-found.jpg') }}">
```

**Saída**

```
<img src="/storage/products/demo.jpg">
```

## Métodos

### `mediaExists`

Verifica se um arquivo de mídia existe no disco informado.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `disk` | Disco configurado em config/filesystems.php. Quando null, usa public. |
| `path` | Caminho relativo da mídia dentro do disco. Valores vazios retornam false. |

**Exemplo**

```php
MediaHelper::mediaExists('products', 'demo.jpg');
```

**Saída**

```
true
```

### `showMedia`

Retorna a URL pública da mídia existente ou a URL de um placeholder quando o arquivo não existe.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `path` | Caminho relativo da mídia dentro do disco. |
| `disk` | Disco configurado em config/filesystems.php. Quando null, usa public. |
| `placeholder` | Caminho de fallback dentro de public, usado quando a mídia não existe. |

**Exemplo**

```php
MediaHelper::showMedia('demo.jpg', 'products', 'img/placeholders/product-image-not-found.jpg');
```

**Saída**

```
/storage/products/demo.jpg
```

### `mediaFullPath`

Retorna o caminho público da mídia sem o APP_URL configurado.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `path` | Caminho relativo da mídia dentro do disco. |
| `disk` | Disco configurado em config/filesystems.php. Quando null, usa public. |

**Exemplo**

```php
MediaHelper::mediaFullPath('manual.pdf', 'downloads');
```

**Saída**

```
/storage/downloads/manual.pdf
```

### `downloadMedia`

Retorna uma resposta de download para um arquivo existente.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `path` | Caminho relativo da mídia dentro do disco. |
| `customName` | Nome personalizado para o arquivo baixado. Quando null, usa o nome original do arquivo. |
| `disk` | Disco configurado em config/filesystems.php. Quando null, usa public. |

**Exemplo**

```php
return MediaHelper::downloadMedia('reports/relatorio-final.pdf', 'Relatorio.pdf', 'public');
```

**Saída**

```
BinaryFileResponse
```

### `mediaMimeType`

Retorna o MIME type de uma mídia existente, ou uma mensagem traduzida quando o arquivo não existe ou não pode ser identificado.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `path` | Caminho relativo da mídia dentro do disco. |
| `disk` | Disco configurado em config/filesystems.php. Quando null, usa public. |

**Exemplo**

```php
MediaHelper::mediaMimeType('avatars/user.jpg', 'public');
```

**Saída**

```
image/jpeg
```
