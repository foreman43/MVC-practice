<?php

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

        if($route[1] != '') {
            $controllerName = ucfirst($route[1]. "Controller");
            $modelName = ucfirst($route[1]. "Model");
        }

        include CONTROLLER_PATH . $controllerName . ".php";
        include MODEL_PATH . $controllerName . ".php";

        if(isset($route[2])) {
            $action = $route[2];
        }

        $controller = new $controllerName();
        $controller->$action();
    }

    public static function showError()
    {

    }
}