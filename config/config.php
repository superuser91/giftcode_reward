<?php

return [
    'giftcodes' => [
        'prefix' => '/admin',
        'middleware' => ['auth:admin'],
        'policy' => 'App\\Policies\\GiftcodePolicy',
        'pjax_container_id' => 'kt_content',
        'layout' => 'layouts.app'
    ]
];
