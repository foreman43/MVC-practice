<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class AuthController extends Controller
{
    public function actionLogin(Request $request)
    {
        if($request->isPost())
        {
            return $this->actionLoginFormSubmit();
        }
        $this->pageInfo['title'] = 'Авторизация';
        return $this->render('login', $this->pageInfo);
    }

    public function actionRegister(Request $request)
    {
        if($request->isPost())
        {
            return $this->actionRegisterFormSubmit();
        }
        $this->pageInfo['title'] = 'Регистрация';
        return $this->render('register', $this->pageInfo);
    }

    public function actionLoginFormSubmit()
    {
        //todo
        return "placeholder";
    }

    public function actionRegisterFormSubmit()
    {
        //todo
        return "placeholder";
    }
}