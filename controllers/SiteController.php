<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use models\SiteModel;

class SiteController extends Controller
{
    public function __construct()
    {

    }

    public function actionIndex(): string
    {
        $this->pageInfo['title'] = "Главная";
        if(!Application::isGuest()) {
            Application::$app->response->redirect('/feedback');
        }
        return $this->render('index', $this->pageInfo);
    }
}