<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use models\SiteModel;

class SiteController extends Controller
{
    public function __construct()
    {

    }

    public function actionIndex(): string
    {
        $this->pageInfo['title'] = "Авторизация пользователя";
        return $this->render('index', $this->pageInfo);
    }
}