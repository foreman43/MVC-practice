<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;

class SiteController extends Controller
{
    public function actionIndex(): string
    {
        $this->pageInfo["title"] = "Главная";
        if(!Application::isGuest()) {
            Application::$app->response->redirect("/feedback");
        }
        return $this->render("index", $this->pageInfo);
    }
}