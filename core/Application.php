<?php
namespace app\core;

class Application
{
    public static string $ROOT;
    public Routing $routing;
    public Request $request;
    public Controller $controller;

    public static Application $app;

    public function __construct($config)
    {
        $this->request = new Request();
        $this->routing = new Routing($this->request);

        self::$ROOT = $config['root'];
        self::$app = $this;
    }

    public function run()
    {
        echo $this->routing->resolve();
    }
}