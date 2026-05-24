# DiskHelper

Salva, substitui, remove e consulta arquivos em discos configurados do Laravel.

## Quando Usar

- Use DiskHelper para centralizar operações de arquivo quando uma funcionalidade recebe uploads e precisa persistir apenas o caminho relativo no banco.
- O parâmetro disk sempre aponta para um disco configurado em config/filesystems.php; subfolders organiza pastas dentro desse disco.
- As subpastas podem ser uma string simples ou um array de strings, permitindo montar caminhos como feminino ou feminino/marco.

## Exemplo

```php
$path = DiskHelper::saveFile($image, 'products', ['feminino', 'marco']);
```

**Saída**

```
feminino/marco/imagem-20260521183000.jpg
```

## Métodos

### `saveFile`

Salva um arquivo enviado em um disco configurado e retorna o caminho relativo que deve ser persistido.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `file` | Arquivo de upload que será salvo. |
| `disk` | Disco onde o arquivo será salvo. Quando omitido, usa public. |
| `subfolders` | Subpasta ou lista de subpastas dentro do disco. |

**Exemplo**

```php
$path = DiskHelper::saveFile($image, 'products', 'feminino');
```

**Saída**

```
feminino/imagem-20260521183000.jpg
```

### `updateFile`

Salva um novo arquivo e remove o arquivo antigo do mesmo disco e das mesmas subpastas.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `newFile` | Novo arquivo de upload que será salvo. |
| `oldFile` | Nome do arquivo antigo, ou caminho relativo quando subfolders não for usado. |
| `disk` | Disco onde o arquivo antigo existe e onde o novo arquivo será salvo. |
| `subfolders` | Subpasta ou lista de subpastas usada para localizar o antigo e salvar o novo arquivo. |

**Exemplo**

```php
$path = DiskHelper::updateFile($image, 'antigo.jpg', 'products', ['feminino', 'marco']);
```

**Saída**

```
feminino/marco/imagem-20260521183000.jpg
```

### `removeFile`

Remove um arquivo de um disco configurado, com suporte opcional a subpastas.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `file` | Nome ou caminho relativo do arquivo que será removido. |
| `disk` | Disco onde o arquivo está armazenado. |
| `subfolders` | Subpasta ou lista de subpastas usada para montar o caminho do arquivo. |

**Exemplo**

```php
DiskHelper::removeFile('imagem.jpg', 'products', 'feminino');
```

**Saída**

```
true
```

### `fileUrl`

Retorna a URL pública de um arquivo existente no disco informado.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `file` | Nome ou caminho relativo do arquivo salvo no disco. |
| `disk` | Disco onde o arquivo está armazenado. |
| `subfolders` | Subpasta ou lista de subpastas usada para montar o caminho do arquivo. |

**Exemplo**

```php
DiskHelper::fileUrl('avatar.jpg', 'public', 'avatars');
```

**Saída**

```
/storage/avatars/avatar.jpg
```

### `fileSize`

Retorna o tamanho formatado de um arquivo existente no disco informado.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `file` | Nome ou caminho relativo do arquivo salvo no disco. |
| `disk` | Disco onde o arquivo está armazenado. |
| `subfolders` | Subpasta ou lista de subpastas usada para montar o caminho do arquivo. |

**Exemplo**

```php
DiskHelper::fileSize('manual.pdf', 'public', 'downloads');
```

**Saída**

```
256 KB
```
