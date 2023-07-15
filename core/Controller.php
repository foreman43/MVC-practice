<?php

namespace app\core;

class Controller
{
    public string $View;
    //todo
    //rewrite $pageInfo
    protected $pageInfo = array();

    public function __construct()
    {

    }

    public function render(string $view, $params = [])
    {
        return Application::$app->routing->renderView($view, $params);
    }
}