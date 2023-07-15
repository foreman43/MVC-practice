<?php

namespace app\controllers;

use app\core\Controller;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $this->pageInfo['title'] = 'Авторизация';
        $this->render('login', $this->pageInfo);
    }

    public function actionRegister()
    {
        $this->pageInfo['title'] = 'Регистрация';
        $this->render('register', $this->pageInfo);
    }
}