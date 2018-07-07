<?php

namespace frontend\controllers;

use common\services\YoutubeService;
use yii\web\Controller;

class YoutubeController extends Controller
{
    /**
     * @return string
     */
    public function actionSearch()
    {
        if ($search = \Yii::$app->request->getQueryParam('search')) {
            $youtubeService = new YoutubeService();

            $youtubeService->search($search);
        }

        return $this->render('search', ['search' => $search ?? null]);
    }
}