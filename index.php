<?php
require_once __DIR__ . "/vendor/autoload.php";

use app\core\Application;

$app = new Application();

$app->routing->get('/PracticMVC/', function (){
    return 'test';
});

$app->run();