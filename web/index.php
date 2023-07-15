<?php
require_once __DIR__ . "/../vendor/autoload.php";

use app\core\Application;
use \app\controllers\SiteController;

$config = [
    'root' => __DIR__."/../",
];
$app = new Application($config);
$app->routing->get('/', [SiteController::class, 'actionIndex']);

$app->routing->get('/feedback', [SiteController::class, 'actionFeedback']);
$app->routing->post('/feedback', [SiteController::class, 'actionFeedbackFormSubmit']);

$app->routing->get('/login', [SiteController::class, 'actionLogin']);
$app->routing->get('/register', [SiteController::class, 'actionRegister']);

$app->run();