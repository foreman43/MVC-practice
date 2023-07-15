<?php

namespace app\controllers;

use app\core\Controller;
use models\IndexModel;

class SiteController extends Controller
{
    public function __construct()
    {

    }

    public function actionIndex()
    {
        $this->pageInfo['title'] = "Авторизация пользователя";
        return $this->render('index', $this->pageInfo);
    }

    public function actionFeedback()
    {

    }
}