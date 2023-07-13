<?php
namespace app\core;

class Application
{
    public Routing $routing;
    public Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->routing = new Routing($this->request);
    }

    public function run()
    {
        $this->routing->resolve();
    }
}