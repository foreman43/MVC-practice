<?php

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'userName' => $_ENV['DB_USER'],
        'usePassword' => $_ENV['DB_PASSWORD'],
    ],
    'root' => __DIR__."/../",
];