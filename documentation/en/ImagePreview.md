# ImagePreview

Visual Livewire image preview for create and edit forms.

## When To Use

- Use ImagePreview when a form needs to preview a selected upload or show an already saved image before replacement.
- Keep file persistence in the parent form or Livewire component. ImagePreview only renders the preview and exposes the selected temporary upload through `wire:model.live`.
- Use it for products, posts, banners, profile images, categories, and modal flows where the upload behavior should stay reusable.

## Variations

### Create Mode

Shows an empty preview area until a new image is selected.

- Starts with the empty state text.
- Uses the selected temporary upload as the preview.
- Sends the uploaded file to the parent property through `wire:model.live`.
- Does not need `path`, `disk`, `placeholder`, or `existing`.

```blade
<livewire:global.image-preview
    mode="create"
    name="banner_image"
    size="col-span-12"
    wire:model.live="banner_image"
/>
```

### Edit Mode

Shows the current image first, then replaces the preview when a new upload is selected.

- Reads the current image from `path` and `disk` when `existing` is true.
- Falls back to `placeholder` when the stored file cannot be found.
- Keeps the existing image visible until the user selects a replacement upload.
- Keeps the save button configurable for forms that save the image separately.

```blade
<livewire:global.image-preview
    mode="edit"
    name="banner_image"
    size="col-span-12"
    :existing="filled($banner->banner_image)"
    :path="$banner->banner_image"
    disk="banners"
    placeholder="img/placeholders/banner-image-not-found.jpg"
    wire:model.live="banner_image"
/>
```

## Configuration

| Option | Type | Default | Description |
| --- | --- | --- | --- |
| `mode` | string | `create` | Controls the visual flow. Use `create` for new records and `edit` for existing records. |
| `name` | string | `image` | File input name and validation error key used by the parent form. |
| `size` | string | `col-span-3` | Layout classes applied to the component wrapper. |
| `existing` | bool | `false` | Tells the component whether it should render an already saved image. |
| `path` | string|null | `null` | Relative path of the existing image inside the configured disk. |
| `disk` | string|null | `public` | Laravel filesystem disk used to resolve the existing image. |
| `placeholder` | string|null | `null` | Public asset shown when the existing image is missing. |
| `accept` | string | `image/*` | Native file input accept value. |
| `hasError` | bool | `false` | Forces the error border when the parent validates the upload outside the component. |
| `showSaveButton` | bool|null | `null` | When null, edit mode shows the save button and create mode hides it. Pass false when the parent form has its own submit button. |

## Parent Save Flow

Use `NormalizesLivewireUploads` when a modal or nested component reuses the same property for the persisted path and the temporary upload.

```php
use App\Livewire\Traits\NormalizesLivewireUploads;

public $banner_image;

public function save(): void
{
    $this->normalizeUpload('banner_image');

    $data = $this->validate([
        'banner_image' => ['required', 'image', 'max:2048'],
    ]);

    $path = DiskHelper::saveFile($data['banner_image'], 'banners');
}
```

## Parent Replace Flow

```php
use App\Livewire\Traits\NormalizesLivewireUploads;

public $banner_image;

public function updateImage(): void
{
    $this->normalizeUpload('banner_image');

    $data = $this->validate([
        'banner_image' => ['required', 'image', 'max:2048'],
    ]);

    $path = DiskHelper::updateFile($data['banner_image'], $this->banner->banner_image, 'banners');
}
```

## Notes

- ImagePreview previews images only. Storing, replacing, and deleting files belongs to the parent form or Livewire component.
- Modal flows that reuse the same property for the persisted path and temporary upload should call `NormalizesLivewireUploads` before validation.
- `MediaHelper` and `DiskHelper` are expected dashboard-base dependencies.
