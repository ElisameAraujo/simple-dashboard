<?php

return [
    'defaults' => [
        'min_chars' => 2,
        'limit' => 12,
        'model_field_weight' => 50,
        'static_field_weights' => [
            'title' => 100,
            'summary' => 45,
            'group' => 30,
            'badge' => 25,
            'keywords' => 80,
        ],
    ],

    'scopes' => [
        'admin' => [
            'min_chars' => 2,
            'limit' => 12,
            'groups' => [],
            'statics' => [],
            'models' => [],
            'actions' => [],
        ],

        'web' => [
            'min_chars' => 2,
            'limit' => 24,
            'groups' => [],
            'statics' => [],
            'models' => [],
            'actions' => [],
        ],
    ],

    'livewire_tables' => [],
];
