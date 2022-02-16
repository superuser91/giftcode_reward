<?php

return [
    'giftcodes' => [
        'prefix' => '/admin',
        'middleware' => ['auth:admin'],
        'policy' => 'App\\Policies\\GiftcodePolicy'
    ]
];
