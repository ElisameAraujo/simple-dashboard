@props([
    'notifications' => [],
    'modalId' => 'adminNotificationsModal',
    'dropdownAlignment' => 'dropdown-end',
    'variant' => 'dropdown',
])

@php
    $notifications = collect($notifications);
    $unreadNotifications = $notifications->filter(fn(array $notification): bool => !($notification['read'] ?? false));
    $unreadCount = $unreadNotifications->count();
    $dropdownNotifications = $unreadNotifications->take(3);
    $titleId = $modalId . 'Title';
@endphp

<div @class([
    'notifications-ui-header' => $variant !== 'mobile',
    'mobile-action-shell mobile-action-notifications notifications-ui-mobile' => $variant === 'mobile',
])>
    @if ($variant === 'mobile')
        <button type="button" class="mobile-action-button notifications-ui-trigger notifications-ui-mobile-button"
            x-bind:class="{ 'mobile-action-button-active': activePanel === 'notifications' }"
            x-on:click="activePanel = activePanel === 'notifications' ? null : 'notifications'"
            x-bind:aria-expanded="activePanel === 'notifications' ? 'true' : 'false'"
            aria-controls="{{ $modalId }}Panel"
            aria-label="{{ __('components/notifications-ui.trigger_label') }}">
            @if ($unreadCount > 0)
                <span class="notifications-ui-count"
                    aria-label="{{ trans_choice('components/notifications-ui.unread_count', $unreadCount, ['count' => $unreadCount]) }}">
                    {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                </span>
            @endif

            <i class="fa-regular fa-bell"></i>
        </button>

        <section id="{{ $modalId }}Panel" class="mobile-actions-panel notifications-ui-mobile-panel"
            aria-labelledby="{{ $titleId }}" x-cloak x-show="activePanel === 'notifications'" x-transition>
    @else
    <div class="dropdown dropdown-bottom {{ $dropdownAlignment }} tooltip" data-tip="{{ __('ui.notifications') }}">
        <button type="button" tabindex="0" class="button notifications-ui-trigger"
            aria-label="{{ __('components/notifications-ui.trigger_label') }}">
            @if ($unreadCount > 0)
                <span class="notifications-ui-count"
                    aria-label="{{ trans_choice('components/notifications-ui.unread_count', $unreadCount, ['count' => $unreadCount]) }}">
                    {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                </span>
            @endif

            <i class="fa-regular fa-bell"></i>
        </button>

        <section tabindex="0" class="dropdown-content notifications-ui-dropdown"
            aria-labelledby="{{ $titleId }}">
    @endif
            <header class="notifications-ui-dropdown-header">
                <strong id="{{ $titleId }}">{{ __('components/notifications-ui.title') }}</strong>

                @if ($unreadCount > 0)
                    <button type="button">{{ __('components/notifications-ui.actions.mark_all_read') }}</button>
                @endif
            </header>

            <div class="notifications-ui-list">
                @forelse ($dropdownNotifications as $notification)
                    <x-admin.notifications-ui.item :notification="$notification" context="dropdown" />
                @empty
                    <div class="notifications-ui-empty">
                        <i class="fa-regular fa-bell-slash"></i>
                        <span>{{ __('components/notifications-ui.empty.dropdown') }}</span>
                    </div>
                @endforelse
            </div>

            <footer class="notifications-ui-dropdown-footer">
                <label for="{{ $modalId }}" role="button">
                    {{ __('components/notifications-ui.actions.view_all') }}
                </label>
                <span>{{ __('components/notifications-ui.backend_free') }}</span>
            </footer>
        </section>

    @if ($variant !== 'mobile')
        </div>
    @endif

    <input type="checkbox" id="{{ $modalId }}" class="modal-toggle" />

    <div class="modal notifications-ui-dialog" role="dialog" aria-modal="true">
        <section class="modal-box notifications-ui-modal">
            <header class="notifications-ui-modal-header">
                <div>
                    <h2>{{ __('components/notifications-ui.modal.title') }}</h2>
                    <p>{{ __('components/notifications-ui.modal.description') }}</p>
                </div>

                <label for="{{ $modalId }}" role="button" class="notifications-ui-modal-close"
                    aria-label="{{ __('components/notifications-ui.actions.close') }}">
                    <i class="fa-solid fa-xmark"></i>
                </label>
            </header>

            <div class="notifications-ui-toolbar">
                <div class="notifications-ui-filters" role="group"
                    aria-label="{{ __('components/notifications-ui.filters.label') }}">
                    <button type="button" class="btn btn-sm btn-success">
                        {{ __('components/notifications-ui.filters.unread') }}
                    </button>
                    <button type="button" class="btn btn-sm btn-ghost">
                        {{ __('components/notifications-ui.filters.all') }}
                    </button>
                    <button type="button" class="btn btn-sm btn-ghost">
                        {{ __('components/notifications-ui.filters.read') }}
                    </button>
                </div>

                <div class="notifications-ui-modal-actions">
                    <button type="button" class="btn btn-sm btn-success">
                        {{ __('components/notifications-ui.actions.mark_all_read') }}
                    </button>
                    <button type="button" class="btn btn-sm btn-error">
                        {{ __('components/notifications-ui.actions.delete_read') }}
                    </button>
                </div>
            </div>

            <div class="notifications-ui-modal-list">
                @forelse ($notifications as $notification)
                    <x-admin.notifications-ui.item :notification="$notification" context="modal" />
                @empty
                    <div class="notifications-ui-empty notifications-ui-empty-modal">
                        <i class="fa-regular fa-bell-slash"></i>
                        <span>{{ __('components/notifications-ui.empty.modal') }}</span>
                    </div>
                @endforelse
            </div>

            <footer class="notifications-ui-modal-footer">
                <span>{{ __('components/notifications-ui.modal.footer') }}</span>
            </footer>
        </section>

        <label for="{{ $modalId }}" class="modal-backdrop">
            {{ __('components/notifications-ui.actions.close') }}
        </label>
    </div>
</div>
