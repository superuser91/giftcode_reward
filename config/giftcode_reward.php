<?php

return [
    'routes' => [
        'get_list_giftcode' => 'admin.giftcodes.categories.index',
        'get_store_giftcode' => 'admin.giftcodes.categories.create',
        'post_store_giftcode' => 'admin.giftcodes.categories.store',
        'get_update_giftcode' => 'admin.giftcodes.categories.edit',
        'put_update_giftcode' => 'admin.giftcodes.categories.update',
        'delete_giftcode' => 'admin.giftcodes.categories.destroy',
        'get_import_giftcode' => 'admin.giftcodes.import',
        'post_import_giftcode' => 'admin.giftcodes.import',
        'get_list_giftcode_record' => 'admin.giftcodes.categories.show',
    ]
];
