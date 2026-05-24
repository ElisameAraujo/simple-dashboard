# MediaHelper

Displays, validates, and returns URLs or responses for media stored on Laravel disks.

## When To Use

- Use MediaHelper when a view or service receives only the path stored in the database and needs to turn it into a public URL, placeholder, download, or MIME type detail.
- The disk parameter points to a disk configured in config/filesystems.php and, in the common dashboard base usage, also represents the public folder used in the final URL.
- The path parameter must be relative to the disk. For example, if the file is stored on the products disk as demo.jpg, showMedia('demo.jpg', 'products') returns /storage/products/demo.jpg.

## Example

```php
<img src="{{ MediaHelper::showMedia($product->product_image, 'products', 'img/placeholders/product-image-not-found.jpg') }}">
```

**Output**

```
<img src="/storage/products/demo.jpg">
```

## Methods

### `mediaExists`

Checks if a media file exists on the given disk.

**Parameters**

| Parameter | Description |
| --- | --- |
| `disk` | Disk configured in config/filesystems.php. When null, public is used. |
| `path` | Relative media path inside the disk. Empty values return false. |

**Example**

```php
MediaHelper::mediaExists('products', 'demo.jpg');
```

**Output**

```
true
```

### `showMedia`

Returns the public URL of an existing media file, or a placeholder URL when the file does not exist.

**Parameters**

| Parameter | Description |
| --- | --- |
| `path` | Relative media path inside the disk. |
| `disk` | Disk configured in config/filesystems.php. When null, public is used. |
| `placeholder` | Fallback path inside public, used when the media file does not exist. |

**Example**

```php
MediaHelper::showMedia('demo.jpg', 'products', 'img/placeholders/product-image-not-found.jpg');
```

**Output**

```
/storage/products/demo.jpg
```

### `mediaFullPath`

Returns the public media path without the configured APP_URL.

**Parameters**

| Parameter | Description |
| --- | --- |
| `path` | Relative media path inside the disk. |
| `disk` | Disk configured in config/filesystems.php. When null, public is used. |

**Example**

```php
MediaHelper::mediaFullPath('manual.pdf', 'downloads');
```

**Output**

```
/storage/downloads/manual.pdf
```

### `downloadMedia`

Returns a download response for an existing file.

**Parameters**

| Parameter | Description |
| --- | --- |
| `path` | Relative media path inside the disk. |
| `customName` | Custom name for the downloaded file. When null, the original file name is used. |
| `disk` | Disk configured in config/filesystems.php. When null, public is used. |

**Example**

```php
return MediaHelper::downloadMedia('reports/final-report.pdf', 'Report.pdf', 'public');
```

**Output**

```
BinaryFileResponse
```

### `mediaMimeType`

Returns the MIME type of an existing media file, or a translated message when the file does not exist or cannot be identified.

**Parameters**

| Parameter | Description |
| --- | --- |
| `path` | Relative media path inside the disk. |
| `disk` | Disk configured in config/filesystems.php. When null, public is used. |

**Example**

```php
MediaHelper::mediaMimeType('avatars/user.jpg', 'public');
```

**Output**

```
image/jpeg
```
