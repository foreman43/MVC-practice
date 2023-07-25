<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Feedback;
use app\models\User;

class FeedbackController extends Controller
{
    public function actionFeedback(Request $request): string
    {
        $this->pageInfo["title"] = "Обратная связь";
        $model = new Feedback();

        if($request->isPost()) {
            $model->putData($request->getSecureData());
            $model->user_id = Application::$app->user->{User::primaryKey()};
            if($model->validate() && $model->sendFeedback()) {
                Application::$app->session->setFlash(
                    "success",
                "Отзыв отправлен! Спасибо за ваше мнение.");
            }
        }

        $this->pageInfo["model"] = $model;
        return $this->render("feedback", $this->pageInfo);
    }
}