<?php

namespace app\core;

class Controller
{
    public string $layout = "main";
    protected $pageInfo = array();

    public function __construct()
    {

    }

    public function render(string $view, $params = [])
    {
        return Application::$app->routing->renderView($view, $params);
    }

    public function setLayout(string $layout)
    {
        $this->layout = $layout;
    }
}