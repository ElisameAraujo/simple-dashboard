# UserHelper

Provides defensive shortcuts for authenticated user data, avatar output, email handling, summaries, and optional Spatie Permission integration.

## When To Use

- Use UserHelper in views, headers, menus, and admin components that need simple authenticated user data without repeating Auth checks.
- info() reads only direct attributes from the User model. It does not load relationships and returns the fallback when the user or column does not exist.
- userIsActive() is configurable for projects that use booleans, status strings, or numeric identifiers to represent active users.
- Spatie methods are optional. They return safe values when the package is installed but the User model has not implemented HasRoles yet.

## Example

```php
UserHelper::userShortSummary();
```

**Output**

```
Maria S. — maria@example.com
```

## Methods

### `userLogged`

Checks if there is an authenticated user.

**Example**

```php
UserHelper::userLogged();
```

**Output**

```
true
```

### `info`

Returns a direct authenticated user attribute or a fallback when the attribute does not exist.

**Parameters**

| Parameter | Description |
| --- | --- |
| `column` | Column or direct attribute name from the User model. |
| `default` | Value returned when there is no authenticated user or when the attribute does not exist. |

**Example**

```php
UserHelper::info('name', 'Guest');
```

**Output**

```
Maria da Silva
```

### `userIsActive`

Checks if a user attribute matches the value configured as active.

**Parameters**

| Parameter | Description |
| --- | --- |
| `column` | Attribute that represents the user status. |
| `activeValue` | Value considered active in the project, such as true, active, or 1. |

**Example**

```php
UserHelper::userIsActive('status', 'active');
```

**Output**

```
true
```

### `userId`

Returns the authenticated user identifier.

**Parameters**

| Parameter | Description |
| --- | --- |
| `column` | Attribute used as identifier. |

**Example**

```php
UserHelper::userId();
```

**Output**

```
1
```

### `username`

Returns the authenticated user's name.

**Parameters**

| Parameter | Description |
| --- | --- |
| `column` | Attribute used as name. |

**Example**

```php
UserHelper::username();
```

**Output**

```
Maria da Silva
```

### `userFirstName`

Returns the authenticated user's first name.

**Parameters**

| Parameter | Description |
| --- | --- |
| `column` | Attribute used as name. |

**Example**

```php
UserHelper::userFirstName();
```

**Output**

```
Maria
```

### `userShortName`

Returns the first name with the last surname initial.

**Parameters**

| Parameter | Description |
| --- | --- |
| `column` | Attribute used as name. |

**Example**

```php
UserHelper::userShortName();
```

**Output**

```
Maria S.
```

### `userEmail`

Returns the authenticated user's email.

**Parameters**

| Parameter | Description |
| --- | --- |
| `column` | Attribute used as email. |

**Example**

```php
UserHelper::userEmail();
```

**Output**

```
maria@example.com
```

### `emailDomain`

Returns the authenticated user's email domain.

**Parameters**

| Parameter | Description |
| --- | --- |
| `column` | Attribute used as email. |

**Example**

```php
UserHelper::emailDomain();
```

**Output**

```
example.com
```

### `maskEmail`

Masks the local part of an email address for safe display.

**Parameters**

| Parameter | Description |
| --- | --- |
| `email` | Email that will be masked. |
| `charactersToMask` | Number of characters to mask. When null or lower than 1, masks the full part before @. |
| `position` | Mask position. Accepts start, middle, or end. |

**Example**

```php
UserHelper::maskEmail('maria.silva@example.com', 5, 'middle');
```

**Output**

```
maria*****a@example.com
```

### `sanitizeEmail`

Removes invalid characters from an email and converts the result to lowercase.

**Parameters**

| Parameter | Description |
| --- | --- |
| `email` | Email that will be sanitized. |

**Example**

```php
UserHelper::sanitizeEmail(' MARIA@example.com ');
```

**Output**

```
maria@example.com
```

### `userAvatar`

Returns the public user avatar URL when the attribute exists, or a placeholder when provided.

**Parameters**

| Parameter | Description |
| --- | --- |
| `column` | Attribute that stores the avatar path. |
| `disk` | Disk configured in filesystems.php. |
| `placeholder` | Public path used when the avatar does not exist. |

**Example**

```php
UserHelper::userAvatar('avatar', 'public', 'img/placeholders/avatars/default-avatar.jpg');
```

**Output**

```
/storage/avatars/user.jpg
```

### `userAvatarPath`

Returns the stored user avatar path without resolving a public URL.

**Parameters**

| Parameter | Description |
| --- | --- |
| `column` | Attribute that stores the avatar path. |

**Example**

```php
UserHelper::userAvatarPath();
```

**Output**

```
avatars/user.jpg
```

### `userAvatarFallback`

Returns initials and a stable color for displaying a text avatar when there is no image.

**Parameters**

| Parameter | Description |
| --- | --- |
| `column` | Attribute used as name to generate initials. |

**Example**

```php
UserHelper::userAvatarFallback();
```

**Output**

```
['initials' => 'MS', 'color' => '#3498db']
```

### `userSummary`

Returns a simple array with authenticated user id, name, and email.

**Parameters**

| Parameter | Description |
| --- | --- |
| `id` | Attribute used as identifier. |
| `name` | Attribute used as name. |
| `email` | Attribute used as email. |

**Example**

```php
UserHelper::userSummary();
```

**Output**

```
['id' => 1, 'name' => 'Maria da Silva', 'email' => 'maria@example.com']
```

### `userShortSummary`

Returns a compact summary with abbreviated authenticated user name and email.

**Parameters**

| Parameter | Description |
| --- | --- |
| `name` | Attribute used as name. |
| `email` | Attribute used as email. |

**Example**

```php
UserHelper::userShortSummary();
```

**Output**

```
Maria S. — maria@example.com
```

### `userHasRole`

Checks if the authenticated user has a role when HasRoles is implemented.

**Parameters**

| Parameter | Description |
| --- | --- |
| `role` | Role name that will be checked. |

**Example**

```php
UserHelper::userHasRole('admin');
```

**Output**

```
true
```

### `userHasPermission`

Checks if the authenticated user has a permission.

**Parameters**

| Parameter | Description |
| --- | --- |
| `permission` | Permission name that will be checked. |

**Example**

```php
UserHelper::userHasPermission('posts.edit');
```

**Output**

```
true
```

### `userRoles`

Returns the user's role names when HasRoles is implemented.

**Example**

```php
UserHelper::userRoles();
```

**Output**

```
['admin', 'editor']
```

### `userPermissions`

Returns all user permission names when HasRoles is implemented.

**Example**

```php
UserHelper::userPermissions();
```

**Output**

```
['posts.create', 'posts.edit']
```

### `allPermissions`

Returns all permission names registered by Spatie Permission.

**Example**

```php
UserHelper::allPermissions();
```

**Output**

```
collect(['posts.create', 'posts.edit'])
```

### `allRoles`

Returns all role names registered by Spatie Permission.

**Example**

```php
UserHelper::allRoles();
```

**Output**

```
collect(['admin', 'editor'])
```
