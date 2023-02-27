<?php

namespace app\controllers\ajax;

use app\common\controllers\AuthAjaxController;
use app\models\UsersLessons;
use yii\web\BadRequestHttpException;

class LessonsController extends AuthAjaxController
{
    public function actionReviewed()
    {
        $lessonId = \Yii::$app->request->post('lessonId', 0);
        if (UsersLessons::findOne(['lesson_id' => $lessonId])) {
            return $this->renderJson(true);
        }
        $userLesson = new UsersLessons(['user_id' => \Yii::$app->user->getId(), 'lesson_id' => $lessonId]);
        if (!$userLesson->save()) {
            return $this->renderJson(false);
        }
        return $this->renderJson(true);
    }
}