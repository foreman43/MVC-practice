<?php

class Application
{
    public Routing $routing;
    public function __construct()
    {
        $this->routing = new Routing();
    }
}