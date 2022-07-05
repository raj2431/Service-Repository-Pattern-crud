<?php
return [
    'app_url' =>   env('APP_URL'),
    'app_domain' =>  env('APP_DOMAIN'),
    'api_status' => [
        'created'      =>    201,
        'success'      =>    200,
        'failed'       =>    403,
        'fatel'        =>    500,
        'redirect'     =>    301,
        'validation'   =>    422,
        'authenticate' =>    401,
        'not_found'    =>    404
    ],

    'pagination' => [
        'api' => 100,
        'admin' => 20
    ],
    "api_key_string" => '$2y$10$Am6Rgg2EhIEmkEoC0O5gX.Xxx1mg4T6yjZgJgebSSYUul6ynMrphG',
    "chat_group_option" => [
        [
            'id' => 1,
            'Value' => "Open to all",
        ],
        [
            'id' => 2,
            'Value' => "Open to all but need approval",
        ],
        [
            'id' => 3,
            'Value' => "Invite only"
        ]
    ],

    "notification_type" => [
        "follow" => 1
    ]
];
