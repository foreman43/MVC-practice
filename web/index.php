<?php
require_once __DIR__ . "/../vendor/autoload.php";

use app\core\Application;
use \app\controllers\SiteController;
use app\controllers\AuthController;

$config = [
    'root' => __DIR__."/../",
];
$app = new Application($config);
$app->routing->get('/', [SiteController::class, 'actionIndex']);

$app->routing->get('/feedback', [SiteController::class, 'actionFeedback']);
$app->routing->post('/feedback', [SiteController::class, 'actionFeedbackFormSubmit']);

$app->routing->get('/login', [AuthController::class, 'actionLogin']);
$app->routing->post('/login', [AuthController::class, 'actionLogin']);

$app->routing->get('/register', [AuthController::class, 'actionRegister']);
$app->routing->post('/register', [AuthController::class, 'actionRegister']);

$app->run();