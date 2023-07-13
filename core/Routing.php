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

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if($callback === false)
        {
            $this->errorPage();
        }

        echo call_user_func($callback);
    }

    public function errorPage()
    {
        echo "404";
    }
}