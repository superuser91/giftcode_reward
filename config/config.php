<?php

return [
    'giftcode' => [
        'prefix' => '/admin',
        'middleware' => ['auth:admin'],
        'permissions' => [
            'index' => 'giftcodes.index',
            'create' => 'giftcodes.create',
            'update' => 'giftcodes.update',
            'delete' => 'giftcodes.delete',
        ]
    ]
];
