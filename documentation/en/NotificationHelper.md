# NotificationHelper

Reads and counts authenticated user notifications for dropdowns, badges, and notification list screens.

## When To Use

- Use NotificationHelper when a view, Livewire component, or controller needs authenticated user notifications without repeating Auth checks.
- The helper is read-focused. Actions such as marking as read, marking all as read, or deleting notifications should live in the Controller or Livewire component that owns the interaction.
- latestNotifications() powers short summaries, such as the header dropdown; allUnreadNotifications() powers complete pending lists that do not fit in the summary.
- When there is no authenticated user, list methods return an empty Collection and count methods return 0.

## Example

```php
$unreadCount = NotificationHelper::allUnreadNotificationsCount();
$dropdownNotifications = NotificationHelper::latestNotifications(10);
```

**Output**

```
15 unread notifications and 10 items for the dropdown.
```

## Methods

### `unreadNotificationsByType`

Lists unread notifications of a specific notification class.

**Parameters**

| Parameter | Description |
| --- | --- |
| `type` | Notification class name or fully qualified class name. |
| `subfolder` | Optional subfolder inside App\Notifications, such as User. |
| `limit` | Optional maximum number of returned records. When null or below 1, all matching records are returned. |

**Example**

```php
NotificationHelper::unreadNotificationsByType('NewMessageNotification', 'User', 5);
```

**Output**

```
Collection with up to 5 unread notifications of type App\Notifications\User\NewMessageNotification.
```

### `unreadNotificationsByTypeCount`

Counts unread notifications of a specific notification class.

**Parameters**

| Parameter | Description |
| --- | --- |
| `type` | Notification class name or fully qualified class name. |
| `subfolder` | Optional subfolder inside App\Notifications, such as User. |

**Example**

```php
NotificationHelper::unreadNotificationsByTypeCount('NewMessageNotification', 'User');
```

**Output**

```
3
```

### `allUnreadNotifications`

Lists all unread notifications for the authenticated user, with an optional limit.

**Parameters**

| Parameter | Description |
| --- | --- |
| `limit` | Optional maximum number of returned records. When null, all unread notifications are returned. |

**Example**

```php
NotificationHelper::allUnreadNotifications();
```

**Output**

```
Collection with all unread notifications.
```

### `allUnreadNotificationsCount`

Counts all unread notifications for the authenticated user.

**Example**

```php
NotificationHelper::allUnreadNotificationsCount();
```

**Output**

```
15
```

### `latestNotifications`

Lists the authenticated user's latest notifications, read or unread, for summaries such as dropdowns.

**Parameters**

| Parameter | Description |
| --- | --- |
| `limit` | Maximum number of returned notifications. When null or below 1, all notifications are returned. |

**Example**

```php
NotificationHelper::latestNotifications(10);
```

**Output**

```
Collection with the 10 latest notifications.
```
