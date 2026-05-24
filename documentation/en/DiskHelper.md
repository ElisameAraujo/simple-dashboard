# DiskHelper

Saves, replaces, removes, and inspects files on configured Laravel disks.

## When To Use

- Use DiskHelper to centralize file operations when a feature receives uploads and only needs to persist the relative path in the database.
- The disk parameter always points to a disk configured in config/filesystems.php; subfolders organize folders inside that disk.
- Subfolders may be a simple string or an array of strings, allowing paths such as feminine or feminine/march.

## Example

```php
$path = DiskHelper::saveFile($image, 'products', ['feminine', 'march']);
```

**Output**

```
feminine/march/image-20260521183000.jpg
```

## Methods

### `saveFile`

Saves an uploaded file to a configured disk and returns the relative path that should be persisted.

**Parameters**

| Parameter | Description |
| --- | --- |
| `file` | Uploaded file that will be saved. |
| `disk` | Disk where the file will be saved. When omitted, public is used. |
| `subfolders` | Subfolder or list of subfolders within the disk. |

**Example**

```php
$path = DiskHelper::saveFile($image, 'products', 'feminine');
```

**Output**

```
feminine/image-20260521183000.jpg
```

### `updateFile`

Saves a new uploaded file and removes the previous file from the same disk and subfolders.

**Parameters**

| Parameter | Description |
| --- | --- |
| `newFile` | New uploaded file that will be saved. |
| `oldFile` | Name of the old file, or relative path when subfolders are not used. |
| `disk` | Disk where the old file exists and the new file will be saved. |
| `subfolders` | Subfolder or list of subfolders used to locate the old file and save the new file. |

**Example**

```php
$path = DiskHelper::updateFile($image, 'old.jpg', 'products', ['feminine', 'march']);
```

**Output**

```
feminine/march/image-20260521183000.jpg
```

### `removeFile`

Removes a file from a configured disk, with optional subfolder support.

**Parameters**

| Parameter | Description |
| --- | --- |
| `file` | File name or relative path that will be removed. |
| `disk` | Disk where the file is stored. |
| `subfolders` | Subfolder or list of subfolders used to build the file path. |

**Example**

```php
DiskHelper::removeFile('image.jpg', 'products', 'feminine');
```

**Output**

```
true
```

### `fileUrl`

Returns the public URL of an existing file on the given disk.

**Parameters**

| Parameter | Description |
| --- | --- |
| `file` | File name or relative path stored on the disk. |
| `disk` | Disk where the file is stored. |
| `subfolders` | Subfolder or list of subfolders used to build the file path. |

**Example**

```php
DiskHelper::fileUrl('avatar.jpg', 'public', 'avatars');
```

**Output**

```
/storage/avatars/avatar.jpg
```

### `fileSize`

Returns the formatted size of an existing file on the given disk.

**Parameters**

| Parameter | Description |
| --- | --- |
| `file` | File name or relative path stored on the disk. |
| `disk` | Disk where the file is stored. |
| `subfolders` | Subfolder or list of subfolders used to build the file path. |

**Example**

```php
DiskHelper::fileSize('manual.pdf', 'public', 'downloads');
```

**Output**

```
256 KB
```
