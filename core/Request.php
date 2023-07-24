<?php

namespace app\core;

class Request
{
    public function getPath(): string
    {
        $path = $_SERVER["REQUEST_URI"];

        if(!$pos = strpos($path,'?')) {
            return $path;
        }
        return substr($path, 0, $pos);
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public function isGet(): bool
    {
        return $this->getMethod() === "get";
    }

    public function isPost(): bool
    {
        return $this->getMethod() === "post";
    }

    public function getSecureData(): array
    {
        $data = [];

        switch ($this->getMethod()) {
            case "get":
                foreach ($_GET as $key=>$value) {
                    $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
                break;
            case "post":
                foreach ($_POST as $key=>$value) {
                    $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
                break;
        }

        return $data;
    }
}