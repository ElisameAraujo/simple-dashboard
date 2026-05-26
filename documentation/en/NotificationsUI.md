# Notifications UI

Visual notification dropdown and modal for the admin header.

## When To Use

- Use Notifications UI when the dashboard needs a notification preview without assuming a backend implementation.
- Keep the data source free. The array can come from Laravel Notifications, a custom table, an API, broadcasts, or any project layer.
- Use the project version as a static visual base. The demo shows the complete Livewire behavior.

## How It Works In The Project

The header builds an example array and passes it to the Blade component:

```blade
<x-admin.notifications-ui.index :notifications="$adminNotifications" />
```

The component renders:

- bell trigger with unread count;
- compact dropdown with recent notifications;
- native DaisyUI modal for the complete list;
- visual actions for marking as read, marking all as read, and deleting.

## Data Contract

```php
[
    'title' => 'Order approved',
    'description' => 'The newest order was approved and is ready for fulfillment.',
    'author' => 'Sales',
    'label' => 'Order',
    'time' => '2 minutes ago',
    'icon' => 'fa-solid fa-bag-shopping',
    'read' => false,
]
```

## DaisyUI Modal

The complete list uses the DaisyUI modal with `modal-toggle`:

```blade
<input type="checkbox" id="adminNotificationsModal" class="modal-toggle" />

<div class="modal" role="dialog">
    <div class="modal-box">...</div>

    <label for="adminNotificationsModal" class="modal-backdrop">Close</label>
</div>
```

This keeps opening, closing, backdrop, and animations without adding `wire-elements/modal` to the project or depending on custom JavaScript.

## Backend Integration

Replace the static header array with a real source:

```php
$adminNotifications = auth()->user()
    ->notifications()
    ->latest()
    ->limit(30)
    ->get()
    ->map(fn ($notification) => [
        'title' => $notification->data['title'] ?? 'Notification',
        'description' => $notification->data['description'] ?? '',
        'author' => $notification->data['author'] ?? 'System',
        'label' => $notification->data['label'] ?? 'Notification',
        'time' => $notification->created_at->diffForHumans(),
        'icon' => $notification->data['icon'] ?? 'fa-regular fa-bell',
        'read' => filled($notification->read_at),
    ]);
```

## Notes

- The project does not install `wire-elements/modal` for this module.
- The action buttons are visual hooks. Connect them to the backend after choosing the real notification source.
- The component does not create migrations, events, queues, or notification classes.
