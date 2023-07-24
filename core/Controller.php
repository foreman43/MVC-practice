<?php

namespace app\core;

class Controller
{
    public string $layout = "main";
    protected $pageInfo = array();

    public function render(string $view, $params = []): string
    {
        return Application::$app->routing->renderView($view, $params);
    }

    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }
}