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
        if(is_array($callback)) {
            $callback[0] = new $callback[0]();
        }
        return call_user_func($callback);
    }

    protected function getLayoutContent($params)
    {
        foreach ($params as $key=>$value)
        {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT . "/views/layouts/main.php";
        return ob_get_clean();
    }

    protected function getViewContent($view, $params)
    {
        foreach ($params as $key=>$value)
        {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT . "/views/$view.php";
        return ob_get_clean();
    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->getLayoutContent();
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }
    
    public function renderView($view, $params = [])
    {
        $layoutContent = $this->getLayoutContent($params);
        $viewContent = $this->getViewContent($view, $params);
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }
}