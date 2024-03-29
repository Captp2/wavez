<?php

namespace frontend\controllers;

use common\services\YoutubeService;
use Faker\Provider\Uuid;
use yii\base\InvalidArgumentException;
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

            $results = $youtubeService->search($search);
        }

        return $this->render('search', [
            'search' => $search ?? null,
            'results' => $results ?? [],
        ]);
    }

    /**
     * @throws \Exception
     */
    public function actionDownload()
    {
        if (!$videoId = \Yii::$app->request->getQueryParam('videoId')) {
            throw new InvalidArgumentException('Sorry, it would appears this video cannot be downloaded');
        }

        $youtubeService = new YoutubeService();
        $file = $youtubeService->download($videoId);

        \Yii::$app->response->sendFile(\Yii::getAlias('@files') . '/'.$file['filePath'], $file['fileName']);
    }
}