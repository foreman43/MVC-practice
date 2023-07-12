<?php

namespace controllers;

use models\Model;
use views\View;

class Controller
{
    public Model $model;
    public View $view;
    protected $pageInfo = array();

    public function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
    }
}