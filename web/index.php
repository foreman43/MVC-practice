<?php
require_once __DIR__ . "/../vendor/autoload.php";

use app\core\Application;
use \app\controllers\SiteController;

$config = [
    'root' => __DIR__."/../",
];
$app = new Application($config);
$app->routing->get('/', 'index');
$app->routing->get('/feedback', 'feedback');
$app->routing->post('/feedback', [SiteController::class, 'feedback']);

$app->run();