<?php
return [
    'propel' => [
        'database' => [
            'connections' => [
                'my_books_library' => [
                    'adapter' => 'mysql',
                    'dsn' => 'mysql:host=localhost;port=3306;dbname=my_books_library',
                    'user' => 'root',
                    'password' => 'tiger',
                    'settings' => [
                        'charset' => 'utf8'
                    ]
                ]
            ]
        ]
    ]
];
