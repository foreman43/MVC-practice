<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\User;
use app\models\LoginForm;

class AuthController extends Controller
{
    public function actionLogin(Request $request)
    {
        $this->pageInfo['title'] = 'Авторизация';
        $model = new LoginForm();

        if($request->isPost()) {
            $model->putData($request->getSecureData());
            if($model->validate() && $model->login()) {
                Application::$app->response->redirect('/');
            }
            $this->pageInfo['model'] = $model;
            return $this->render('login', $this->pageInfo);
        }

        $this->pageInfo['model'] = $model;
        return $this->render('login', $this->pageInfo);
    }

    public function actionRegister(Request $request)
    {
        $this->pageInfo['title'] = 'Регистрация';
        $model = new User();

        if($request->isPost()) {
            $model->putData($request->getSecureData());
            if($model->validate() && $model->register()) {
                Application::$app->session->setFlash(
                    'success',
                    'Registration was successful!'
                );
                Application::$app->response->redirect('/');
            }

            $this->pageInfo['model'] = $model;
            return $this->render('register',$this->pageInfo);
        }

        $this->pageInfo['model'] = $model;
        return $this->render('register', $this->pageInfo);
    }
}