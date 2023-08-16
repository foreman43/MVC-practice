<?php
require_once __DIR__ . "/vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;
use app\controllers\FeedbackController;

$config = [
    "db" => [
        "dsn" => $_ENV["DB_DSN"],
        "userName" => $_ENV["DB_USER"],
        "usePassword" => $_ENV["DB_PASSWORD"],
    ],
    "root" => __DIR__."/",
    "userClass" => "app\models\User",
];

$app = new Application($config);
$app->routing->get("/", [SiteController::class, "actionIndex"]);

$app->routing->get("/feedback", [FeedbackController::class, "actionFeedback"]);
$app->routing->post("/feedback", [FeedbackController::class, "actionFeedback"]);

$app->routing->get("/login", [AuthController::class, "actionLogin"]);
$app->routing->post("/login", [AuthController::class, "actionLogin"]);

$app->routing->get("/logout", [AuthController::class, "actionLogout"]);

$app->routing->get("/register", [AuthController::class, "actionRegister"]);
$app->routing->post("/register", [AuthController::class, "actionRegister"]);

$app->run();