<?php

namespace common\components;

use yii\base\InvalidArgumentException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class YoutubeGridView extends Widget
{
    public $collection;
    public $result;

    public function init()
    {
        parent::init();
        if (!$this->collection) {
            throw new InvalidArgumentException("YoutubeGridView needs a valid collection attribute");
        }
    }

    public function run()
    {
        $this->result .= Html::beginTag('div', ['class' => 'youtube-video-results']);
        foreach ($this->collection as $video) {
            $this->result .= Html::beginTag('div', ['class' => 'youtube-video-container']);
            $this->renderVideo($video);
            $this->result .= Html::endTag('div');
        }
        $this->result .= Html::endTag('div');

        return $this->result;
    }

    public function renderVideo($video)
    {
        $this->result .= Html::beginTag('div', ['class' => 'youtube-video-title', 'data-videoId' => $video['id']['videoId'] ?? null]);
        $this->result .= Html::label($video['snippet']['title']);
        $this->result .= Html::endTag('div');
        $this->result .= Html::img($video['snippet']['thumbnails']['medium']['url'], ['class' => 'youtube-video-thumbnail']);
        $this->result .= Html::a(
            'Download',
            Url::to(['youtube/download', 'videoId' => $video['id']['videoId'] ?? null]),
            ['class' => 'btn btn-primary youtube-video-title']
        );
    }
}