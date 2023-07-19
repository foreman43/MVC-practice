<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\User;
use app\models\LoginForm;

class AuthController extends Controller
{
    public function actionLogin(Request $request): string
    {
        $this->pageInfo['title'] = 'Авторизация';
        $model = new LoginForm();

        if($request->isPost()) {
            $model->putData($request->getSecureData());
            if($model->validate() && $model->login()) {
                $curUser = Application::$app->user->name ?? Application::$app->user->email;
                Application::$app->session->setFlash(
                    'success',
                    "You loged in as $curUser"
                );
                Application::$app->response->redirect('/');
            }
        }

        $this->pageInfo['model'] = $model;
        return $this->render('login', $this->pageInfo);
    }

    public function actionLogout(): string
    {
        Application::$app->logout();
        Application::$app->response->redirect('/');
    }

    public function actionRegister(Request $request): string
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
        }

        $this->pageInfo['model'] = $model;
        return $this->render('register', $this->pageInfo);
    }
}