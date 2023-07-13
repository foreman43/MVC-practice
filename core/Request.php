<?php

namespace app\core;

class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'];

        if(!$pos = strpos($path,'?')) {
            return $path;
        }
        return substr($path, 0, $pos);
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
        //todo
    }
}