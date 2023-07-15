<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
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
        $this->pageInfo['title'] = "Обратная связь";
        return $this->render('feedback', $this->pageInfo);
    }

    public function actionFeedbackFormSubmit(Request $request)
    {
        $data = $request->getSecureData();
    }
}