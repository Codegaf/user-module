<?php

$urlBase = config('app.url');

return [
    'name' => 'User',

    'menu' => [
        "url" => "",
        "name" => "users",
        "slug" => "users",
        "icon" => "feather icon-users",
        "submenu" => [
            [
                "url" => $urlBase . "/user",
                "name" => "list",
                "icon" => "feather icon-list",
            ],
            [
                "url" => $urlBase . "/user/create",
                "name" => "create",
                "icon" => "feather icon-plus"
            ]

        ]
    ],

    'front' => [
        'validation' => [
            'create' => [
                'rules' => [
                    'email' => [
                        'required' => true,
                        'email' => true
                    ],
                    'name' => [
                        'required' => true,
                        'maxlength' => 191
                    ],
                    'password' => [
                        'required' => true,
                        'minlength' => 8,
                        'pwcheck' => true
                    ],
                    'password_confirmation' => [
                        'equalTo' => '#password'
                    ]
                ],
                'messages' => [
                    'password' => [

                    ]
                ]
            ],
            'edit' => [
                'rules' => [
                    'email' => [
                        'required' => true,
                        'email' => true
                    ],
                    'name' => [
                        'required' => true,
                        'maxlength' => 191
                    ],
                    'password' => [
                        'required' => false,
                        'minlength' => 8,
                        'pwcheck' => false
                    ],
                    'password_confirmation' => [
                        'equalTo' => '#password'
                    ]
                ],
                'messages' => [
                    'password' => [

                    ]
                ]
            ]


        ]
    ]
];
