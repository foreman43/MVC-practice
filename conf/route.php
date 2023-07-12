<?php

use controllers\IndexController;

/*
 ** http://localhost/PracticMVC/
 ** http://localhost/PracticMVC/login/
 ** http://localhost/PracticMVC/register/
 ** http://localhost/PracticMVC/account/feedback/
 ** */

class Routing
{
    public static function buildRoute()
    {
        $controllerName = "IndexController";
        $action = "IndexAction";
        $modelName = "IndexModel";

        $route = explode('/', $_SERVER['REQUEST_URI']);

        if($route[2] != '') {
            $controllerName = ucfirst($route[1]. "Controller");
            $modelName = ucfirst($route[1]. "Model");
        }

        include CONTROLLER_PATH . $controllerName . ".php";
        include MODEL_PATH . $modelName . ".php";

        if(isset($route[3]) && $route[3] != '') {
            $action = $route[3];
        }

        $controller = new $controllerName();
        //$controller = new $controllerName();
        $controller->$action();
    }

    public static function showError()
    {

    }
}