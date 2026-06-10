# Rich Text Media

Generic media flow for images embedded in rich text editors.

## When To Use

- Use Rich Text Media when a textarea/editor can receive inline image uploads.
- Use it for posts, pages, product descriptions, documentation blocks, landing pages, or any content that stores HTML.
- Use it when the editor can be TinyMCE, CKEditor, Quill, Froala, Tiptap, Lexical, or any other WYSIWYG editor that supports custom upload callbacks.

## What It Solves

Rich text editors upload images before the final model always exists.

This module separates the flow into two modes:

| Mode | Purpose |
| --- | --- |
| `temporary` | Used while creating a new record. Images go to a draft folder. |
| `owner` | Used while editing an existing record. Images go directly to the record folder. |

When the record is saved, temporary images are moved to the owner folder and the HTML is rewritten with the final URLs.

## Main Files

| File | Purpose |
| --- | --- |
| `app/Services/Media/RichTextMediaManager.php` | Stores, commits, syncs, prunes, and deletes editor images. |
| `app/Http/Controllers/Admin/Media/RichTextMediaUploadController.php` | Receives editor uploads and returns a generic JSON response. |
| `routes/admin/media/rich-text-media-routes.php` | Registers the upload endpoint. |

## Upload Endpoint

The default endpoint is:

```text
POST /admin/media/rich-text/uploads
```

Named route:

```php
route('admin.rich-text-media.uploads.store')
```

Expected payload:

| Field | Required | Description |
| --- | --- | --- |
| `file` | yes | Uploaded image file. |
| `disk` | yes | Laravel filesystem disk where the image should be stored. |
| `mode` | yes | `temporary` or `owner`. |
| `temporary_key` | when `mode=temporary` | Draft key used before the model exists. |
| `owner_key` | when `mode=owner` | Final model key, usually the model id or slug. |

Response:

```json
{
    "url": "/storage/posts/15/image.jpg",
    "location": "/storage/posts/15/image.jpg",
    "path": "15/image.jpg"
}
```

`location` is included because TinyMCE expects that name by default. Other editors can use `url`.

## Create Flow

When creating a record, generate a temporary key before rendering the form.

```php
use Illuminate\Support\Str;

$temporaryKey = (string) Str::uuid();
```

Configure the editor upload request with:

```json
{
    "disk": "posts",
    "mode": "temporary",
    "temporary_key": "draft-key"
}
```

After the model is created, commit the images:

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

## Edit Flow

When editing an existing record, upload directly to the owner folder:

```json
{
    "disk": "posts",
    "mode": "owner",
    "owner_key": "15"
}
```

After saving the edited HTML, sync the folder so removed inline images are deleted from disk:

```php
use App\Services\Media\RichTextMediaManager;

$post->update($data);

app(RichTextMediaManager::class)->syncOwnerImages(
    disk: 'posts',
    ownerKey: $post->id,
    html: $post->content,
);
```

## Delete Flow

When deleting the owner model, remove its rich text media folder:

```php
app(RichTextMediaManager::class)->deleteOwnerDirectory('posts', $post->id);

$post->delete();
```

If a user cancels a create form, remove the draft folder:

```php
app(RichTextMediaManager::class)->deleteTemporaryDirectory('posts', $temporaryKey);
```

## Scheduled Cleanup

Temporary folders can be cleaned with:

```php
app(RichTextMediaManager::class)->pruneTemporaryDirectories('posts', olderThanHours: 24);
```

You can call it from `routes/console.php`, a scheduled command, or any project-specific cleanup job.

## Editor Examples

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

Use a custom image handler, upload the selected file, then insert the returned URL:

```js
const range = quill.getSelection()
quill.insertEmbed(range.index, 'image', data.url)
```

### Froala

Point the editor image upload URL to the module endpoint and map the returned `url` or `link` according to your Froala configuration.

### Tiptap

Upload the file in a custom command or extension, then call `setImage({ src: data.url })`.

### Lexical

Upload the file from your custom image node flow, then store the returned `url` in the node payload.

## Notes

- The module only handles media lifecycle. Your editor initialization stays inside your project.
- The upload endpoint accepts any configured Laravel disk.
- The folder key is sanitized and cannot be empty.
- Keep authorization and middleware aligned with your admin area before exposing the upload endpoint in production.
