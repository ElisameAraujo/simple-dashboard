<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    |
    | Essa é uma lista de helpers personalizados para facilitar o desenvolvimento
    | de aplicações com Laravel. Você pode adicionar ou remover helpers conforme
    | necessário. Todos esses helpers estão disponíveis globalmente na aplicação.
    |
    */

    'global' => [
        'DateHelper'            => App\Helpers\DateHelper::class,
        'DiskHelper'            => App\Helpers\DiskHelper::class,
        'MediaHelper'           => App\Helpers\MediaHelper::class,
        'NotificationHelper'    => App\Helpers\NotificationHelper::class,
        'NumberHelper'          => App\Helpers\NumberHelper::class,
        'RouteHelper'           => App\Helpers\RouteHelper::class,
        'TextHelper'            => App\Helpers\TextHelper::class,
        'UserHelper'            => App\Helpers\UserHelper::class,
    ],
];
