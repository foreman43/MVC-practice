<?php
require_once("conf\config.php");
$app = new Application();

$route = new Routing();

$app->routing->get('/', function (){
    return 'test';
});

$app->run();