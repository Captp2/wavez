<?php

namespace frontend\controllers;

use common\models\User;
use common\traits\ControllerUtilTrait;
use yii\web\Controller;

class UserController extends Controller
{
    use ControllerUtilTrait;

    public $modelClass = User::class;

    /**
     * @param int $id
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionView(int $id): string
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }
}