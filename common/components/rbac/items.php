<?php
return [
    'adminPanel' => [
        'type' => 2,
        'description' => 'Админ',
    ],
    'user' => [
        'type' => 1,
        'description' => 'Пользователь',
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Админ',
        'children' => [
            'user',
        ],
    ],
];
