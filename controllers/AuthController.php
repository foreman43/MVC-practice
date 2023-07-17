<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\User;

class AuthController extends Controller
{
    public function actionLogin(Request $request)
    {
        if($request->isPost())
        {
            //todo: Implement function after fixing database & creating a LoginModel
        }

        $this->pageInfo['title'] = 'Авторизация';
        return $this->render('login', $this->pageInfo);
    }

    public function actionRegister(Request $request)
    {
        $this->pageInfo['title'] = 'Регистрация';
        $model = new User();

        if($request->isPost()) {
            $model->putData($request->getSecureData());
            if($model->validate() && $model->register()) {
                return $this->render('index',['title' => 'Профиль'] );
            }

            $this->pageInfo['model'] = $model;
            return $this->render('register',$this->pageInfo);
        }

        $this->pageInfo['model'] = $model;
        return $this->render('register', $this->pageInfo);
    }
}