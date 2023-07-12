<?php

namespace controllers;

use models\IndexModel;
use views\View;

class IndexController extends Controller
{
    private $pageTpl = "/views/main.tpl.php";

    public function __construct()
    {
        $this->model = new IndexModel();
        $this->view = new View();
    }

    public function index()
    {
        $this->pageInfo['title'] = "Авторизация пользователя";
        $this->view->render($this->pageTpl, $this->pageInfo);
    }
}