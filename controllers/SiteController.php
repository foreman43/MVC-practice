<?php

namespace app\controllers;

use models\IndexModel;

class SiteController extends Controller
{
    private $pageTpl = "/views/main.tpl.php";

    public function __construct()
    {
        $this->model = new IndexModel();
    }

    public function actionIndex()
    {
        $this->pageInfo['title'] = "Авторизация пользователя";
    }
}