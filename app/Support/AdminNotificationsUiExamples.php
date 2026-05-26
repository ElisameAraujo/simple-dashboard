<?php

namespace App\Support;

class AdminNotificationsUiExamples
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public static function all(): array
    {
        return [
            [
                'title' => __('components/notifications-ui.examples.order.title'),
                'description' => __('components/notifications-ui.examples.order.description'),
                'author' => __('components/notifications-ui.examples.order.author'),
                'label' => __('components/notifications-ui.examples.order.label'),
                'time' => __('components/notifications-ui.examples.order.time'),
                'icon' => 'fa-solid fa-bag-shopping',
                'read' => false,
            ],
            [
                'title' => __('components/notifications-ui.examples.message.title'),
                'description' => __('components/notifications-ui.examples.message.description'),
                'author' => __('components/notifications-ui.examples.message.author'),
                'label' => __('components/notifications-ui.examples.message.label'),
                'time' => __('components/notifications-ui.examples.message.time'),
                'icon' => 'fa-regular fa-envelope',
                'read' => false,
            ],
            [
                'title' => __('components/notifications-ui.examples.comment.title'),
                'description' => __('components/notifications-ui.examples.comment.description'),
                'author' => __('components/notifications-ui.examples.comment.author'),
                'label' => __('components/notifications-ui.examples.comment.label'),
                'time' => __('components/notifications-ui.examples.comment.time'),
                'icon' => 'fa-regular fa-comment-dots',
                'read' => false,
            ],
            [
                'title' => __('components/notifications-ui.examples.backup.title'),
                'description' => __('components/notifications-ui.examples.backup.description'),
                'author' => __('components/notifications-ui.examples.backup.author'),
                'label' => __('components/notifications-ui.examples.backup.label'),
                'time' => __('components/notifications-ui.examples.backup.time'),
                'icon' => 'fa-solid fa-database',
                'read' => true,
            ],
        ];
    }
}
