<?php

namespace app\controllers;

use models\Model;

class Controller
{
    public Model $model;
    //todo
    //rewrite $pageInfo
    protected $pageInfo = array();

    public function __construct()
    {
        $this->model = new Model();
    }
}