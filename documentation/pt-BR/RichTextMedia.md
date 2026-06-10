# Rich Text Media

Fluxo genérico de mídia para imagens embutidas em editores de texto rico.

## Quando Usar

- Use Rich Text Media quando um textarea/editor pode receber upload de imagens no conteúdo.
- Use em posts, páginas, descrições de produtos, blocos de documentação, landing pages ou qualquer conteúdo salvo como HTML.
- Use quando o editor pode ser TinyMCE, CKEditor, Quill, Froala, Tiptap, Lexical ou qualquer outro WYSIWYG com callbacks de upload.

## O Que Ele Resolve

Editores de texto rico enviam imagens antes do registro final sempre existir.

Este módulo separa o fluxo em dois modos:

| Modo | Finalidade |
| --- | --- |
| `temporary` | Usado durante a criação de um novo registro. As imagens vão para uma pasta de rascunho. |
| `owner` | Usado durante a edição de um registro existente. As imagens vão direto para a pasta do registro. |

Quando o registro é salvo, as imagens temporárias são movidas para a pasta final e o HTML é reescrito com as URLs definitivas.

## Arquivos Principais

| Arquivo | Função |
| --- | --- |
| `app/Services/Media/RichTextMediaManager.php` | Salva, confirma, sincroniza, limpa e remove imagens do editor. |
| `app/Http/Controllers/Admin/Media/RichTextMediaUploadController.php` | Recebe uploads do editor e retorna uma resposta JSON genérica. |
| `routes/admin/media/rich-text-media-routes.php` | Registra o endpoint de upload. |

## Endpoint De Upload

O endpoint padrão é:

```text
POST /admin/media/rich-text/uploads
```

Rota nomeada:

```php
route('admin.rich-text-media.uploads.store')
```

Payload esperado:

| Campo | Obrigatório | Descrição |
| --- | --- | --- |
| `file` | sim | Imagem enviada pelo editor. |
| `disk` | sim | Disk Laravel onde a imagem será salva. |
| `mode` | sim | `temporary` ou `owner`. |
| `temporary_key` | quando `mode=temporary` | Chave de rascunho usada antes da model existir. |
| `owner_key` | quando `mode=owner` | Chave final da model, normalmente o id ou slug. |

Resposta:

```json
{
    "url": "/storage/posts/15/image.jpg",
    "location": "/storage/posts/15/image.jpg",
    "path": "15/image.jpg"
}
```

`location` é incluído porque o TinyMCE espera esse nome por padrão. Outros editores podem usar `url`.

## Fluxo De Criação

Ao criar um registro, gere uma chave temporária antes de renderizar o formulário.

```php
use Illuminate\Support\Str;

$temporaryKey = (string) Str::uuid();
```

Configure o upload do editor com:

```json
{
    "disk": "posts",
    "mode": "temporary",
    "temporary_key": "draft-key"
}
```

Depois que a model for criada, confirme as imagens:

```php
use App\Services\Media\RichTextMediaManager;

$post = Post::create($data);

$post->content = app(RichTextMediaManager::class)->commitTemporaryImages(
    disk: 'posts',
    temporaryKey: $temporaryKey,
    ownerKey: $post->id,
    html: $data['content'],
);

$post->save();
```

## Fluxo De Edição

Ao editar um registro existente, envie direto para a pasta do dono:

```json
{
    "disk": "posts",
    "mode": "owner",
    "owner_key": "15"
}
```

Depois de salvar o HTML editado, sincronize a pasta para remover imagens que saíram do conteúdo:

```php
use App\Services\Media\RichTextMediaManager;

$post->update($data);

app(RichTextMediaManager::class)->syncOwnerImages(
    disk: 'posts',
    ownerKey: $post->id,
    html: $post->content,
);
```

## Fluxo De Remoção

Ao remover a model dona do conteúdo, remova também a pasta das mídias:

```php
app(RichTextMediaManager::class)->deleteOwnerDirectory('posts', $post->id);

$post->delete();
```

Se o usuário cancelar um formulário de criação, remova a pasta temporária:

```php
app(RichTextMediaManager::class)->deleteTemporaryDirectory('posts', $temporaryKey);
```

## Limpeza Agendada

Pastas temporárias podem ser limpas com:

```php
app(RichTextMediaManager::class)->pruneTemporaryDirectories('posts', olderThanHours: 24);
```

Você pode chamar isso em `routes/console.php`, em um command agendado ou em qualquer rotina de limpeza específica do projeto.

## Exemplos De Editores

### TinyMCE

```js
images_upload_handler: async (blobInfo) => {
    const formData = new FormData()
    formData.append('file', blobInfo.blob(), blobInfo.filename())
    formData.append('disk', 'posts')
    formData.append('mode', 'temporary')
    formData.append('temporary_key', temporaryKey)

    const response = await fetch(uploadUrl, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken },
        body: formData,
    })

    const data = await response.json()

    return data.location
}
```

### CKEditor

```js
class UploadAdapter {
    constructor(loader) {
        this.loader = loader
    }

    async upload() {
        const file = await this.loader.file
        const formData = new FormData()
        formData.append('file', file)
        formData.append('disk', 'posts')
        formData.append('mode', 'owner')
        formData.append('owner_key', ownerKey)

        const response = await fetch(uploadUrl, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            body: formData,
        })

        const data = await response.json()

        return { default: data.url }
    }
}
```

### Quill

Use um image handler customizado, envie o arquivo selecionado e insira a URL retornada:

```js
const range = quill.getSelection()
quill.insertEmbed(range.index, 'image', data.url)
```

### Froala

Aponte a URL de upload de imagem para o endpoint do módulo e mapeie o retorno `url` ou `link` conforme a configuração do Froala no projeto.

### Tiptap

Faça o upload em um command ou extension customizada e depois chame `setImage({ src: data.url })`.

### Lexical

Faça o upload pelo fluxo customizado do seu image node e salve a `url` retornada no payload do node.

## Observações

- O módulo cuida apenas do ciclo de vida das mídias. A inicialização do editor continua dentro do projeto.
- O endpoint de upload aceita qualquer disk Laravel configurado.
- A chave da pasta é sanitizada e não pode ficar vazia.
- Ajuste autorização e middleware conforme a área administrativa antes de expor o endpoint em produção.
