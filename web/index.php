<?php
require_once __DIR__ . "/../vendor/autoload.php";

use app\core\Application;

$config = [
    'root' => __DIR__."/../",
];
$app = new Application($config);
$app->routing->get('/', 'index');

$app->run();