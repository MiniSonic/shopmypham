<?php

return [
    // Config common
    'del_flag' => [
        'active' => 0,
        'disable' => 1,
    ],

    'status' => [
        'active' => 0,
        'disable' => 1,
    ],

    'status_alias' => [
        'active' => "Hoạt động",
        'disable' => "Tạm khóa",
    ],

    'gender' => [
        'boy' => 1,
        'girl' => 2,
    ],

    'gender_alias' => [
        'girl' => "Gái",
        'boy' => "Trai",
    ],

    'pagination' => [
        'backend' => 20,
        'frontend' => 12,
    ],

    'key_form_data_old' => '_formDataOld',
    'parent_id_default' => 0,
    'category_level_default' => 1,

    'system' => [
        // system
        'SITE_NAME' => env('SITE_NAME'),
        'SITE_PHONE' => env('SITE_PHONE'),
        'SITE_FAVICON' => env('SITE_FAVICON'),
        'SITE_TITLE' => env('SITE_TITLE'),
        'META_TITLE' => env('META_TITLE'),
        'META_DESCRIPTION' => env('META_DESCRIPTION'),

        // send mail
        'MAIL_DRIVER' => env('MAIL_DRIVER'),
        'MAIL_HOST' => env('MAIL_HOST'),
        'MAIL_PORT' => env('MAIL_PORT'),
        'MAIL_USERNAME' => env('MAIL_USERNAME'),
        'MAIL_PASSWORD' => env('MAIL_PASSWORD'),
        'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
        'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
        'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
    ],

    'cpu' => [
        3 => 'i3',
        5 => 'i5',
        7 => 'i7',
    ],

    'ram' => [
        4 => '4g',
        6 => '6g',
        8 => '8g',
        12 => '12g',
        16 => '16g',
        32 => '32g',
    ],

    'order-status' => [
        1 => 'New',
        2 => 'Success',
        3 => 'Cancel by admin',
        4 => 'Cancel by user',
    ],
    'order-status-new' => 1,
    'order-status-success' => 2,
    'order-status-cancel-by-admin' => 3,

    'product' => [
        'hot' => ['Không', 'Có']
    ],
    'product-hot' => 1,
    'product-no-hot' => 2,

    // BACKEND AREA
    'admin' => [
        'role' => [
            'superadmin' => ['id' => 1, 'alias' => 'Superadmin'],
            'admin' => ['id' => 2, 'alias' => 'Admin'],
        ]
    ],

    // FRONTEND AREA
    'user' => [
        'status' => [
            'active' => 1,
            'block' => 2,
        ]
    ]
];
