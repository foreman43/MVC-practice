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
    }

    public function getSecureData()
    {
        $data = [];

        switch ($this->getMethod()) {
            case 'get':
                foreach ($_GET as $key=>$value) {
                    $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
                break;
            case 'post':
                foreach ($_POST as $key=>$value) {
                    $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
                break;
        }

        return $data;
    }
}