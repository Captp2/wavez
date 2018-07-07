<?php

namespace frontend\controllers;

use common\models\User;
use common\traits\ControllerUtilTrait;
use Masih\YoutubeDownloader\YoutubeDownloader;
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

    /**
     * @param int $id
     * @return string|\yii\web\Response
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if (\Yii::$app->request->isPost) {
            $this->handleForm($model, \Yii::$app->request->getBodyParams());

            return $this->redirect(\Yii::$app->request->referrer);
        }

        return $this->render('update', ['model' => $model]);
    }

    /**
     * @param User $model
     * @param array $post
     * @return User
     */
    public function handleForm(User $model, array $post): User
    {
        $model->load($post, 'User');
        $model->save();

        return $model;
    }
}