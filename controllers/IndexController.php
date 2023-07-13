<?php

namespace controllers;

use models\IndexModel;

class IndexController extends Controller
{
    private $pageTpl = "/views/main.tpl.php";

    public function __construct()
    {
        $this->model = new IndexModel();
    }

    public function index()
    {
        $this->pageInfo['title'] = "Авторизация пользователя";
    }
}