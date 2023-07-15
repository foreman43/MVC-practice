<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

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
        $registerModel = new RegisterModel();

        if($request->isPost()) {
            $registerModel->putData($request->getSecureData());
            if($registerModel->validate() && $registerModel->register()) {
                return "success"; //todo: replace string by success page(?)
            }

            $this->pageInfo['model'] = $registerModel;
            var_dump($registerModel->errors);
            return $this->render('register',$this->pageInfo);
        }

        return $this->render('register', $this->pageInfo);
    }
}