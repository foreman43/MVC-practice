<?php
namespace app\core;
/*
 ** http://localhost/PracticMVC/
 ** http://localhost/PracticMVC/login/
 ** http://localhost/PracticMVC/register/
 ** http://localhost/PracticMVC/account/feedback/
 ** */

class Routing
{
    protected array $routes = [];
    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get(string $path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if($callback === false) {
            return $this->renderView("_404");
        }

        if(is_string($callback)) {
            return $this->renderView($callback);
        }
    }

    protected function getLayoutContent()
    {
        ob_start();
        include_once Application::$ROOT . "/views/layouts/main.php";
        return ob_get_clean();
    }

    protected function getViewContent($view)
    {
        ob_start();
        include_once Application::$ROOT . "/views/$view.php";
        return ob_get_clean();
    }

    //todo
    public function renderContent($viewContent)
    {
        $layoutContent = $this->getLayoutContent();
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }
    
    public function renderView($view)
    {
        $layoutContent = $this->getLayoutContent();
        $viewContent = $this->getViewContent($view);
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }
}