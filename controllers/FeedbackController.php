<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Feedback;

class FeedbackController extends Controller
{
    public function actionFeedback(Request $request): string
    {
        $this->pageInfo['title'] = "Обратная связь";
        $model = new Feedback();

        if($request->isPost()) {
            $model->putData($request->getSecureData());
            if($model->validate() && $model->sandFeedback()) {
                Application::$app->session->setFlash(
                    'success',
                'Feedback was sent! Thanks for your opinion.');
            }
        }

        $this->pageInfo['model'] = $model;
        return $this->render('feedback', $this->pageInfo);
    }
}