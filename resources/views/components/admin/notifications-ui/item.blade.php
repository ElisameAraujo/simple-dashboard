@props([
    'notification',
    'context' => 'dropdown',
])

@php
    $isUnread = ! ($notification['read'] ?? false);
    $title = $notification['title'] ?? __('components/notifications-ui.fallback.title');
    $author = $notification['author'] ?? __('components/notifications-ui.fallback.author');
    $label = $notification['label'] ?? __('components/notifications-ui.fallback.label');
    $description = $notification['description'] ?? '';
    $time = $notification['time'] ?? null;
    $icon = $notification['icon'] ?? 'fa-regular fa-bell';
@endphp

<article class="notifications-ui-item {{ $isUnread ? 'notifications-ui-item-unread' : '' }} notifications-ui-item-{{ $context }}">
    <div class="notifications-ui-icon" aria-hidden="true">
        <i class="{{ $icon }}"></i>
    </div>

    <div class="notifications-ui-body">
        <div class="notifications-ui-title-row">
            <h3 class="notifications-ui-title">{{ $title }}</h3>

            @if ($context === 'modal')
                <span class="notifications-ui-badge">{{ $label }}</span>
            @endif
        </div>

        <span class="notifications-ui-author">{{ $author }}</span>

        @if ($description)
            <p class="notifications-ui-content">{{ $description }}</p>
        @endif

        @if ($time)
            <time class="notifications-ui-date">{{ $time }}</time>
        @endif
    </div>

    @if ($context === 'modal')
        <div class="notifications-ui-actions">
            @if ($isUnread)
                <button type="button" class="notifications-ui-action notifications-ui-action-success"
                    aria-label="{{ __('components/notifications-ui.actions.mark_read') }}">
                    <i class="fa-solid fa-check"></i>
                </button>
            @endif

            <button type="button" class="notifications-ui-action notifications-ui-action-danger"
                aria-label="{{ __('components/notifications-ui.actions.delete') }}">
                <i class="fa-regular fa-trash-can"></i>
            </button>
        </div>
    @endif
</article>
