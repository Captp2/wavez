<?php

namespace common\services;

use Madcoda\Youtube\Youtube;
use Masih\YoutubeDownloader\YoutubeDownloader;
use yii\base\Component;

class YoutubeService extends Component
{
    /** @var Youtube */
    public $youtubeApi;
    /** @var string */
    public $filePath;

    /**
     * @throws \Exception
     */
    public function init()
    {
        $this->youtubeApi = new Youtube(['key' => 'AIzaSyBmHXvBqZrf6jEjC3iwdJD3-j1-kkefjCM']);
        $this->filePath = '../../files';
    }

    public function search(string $search)
    {
        return $this->getArray($this->youtubeApi->search($search));
    }

    /**
     * @param string $videoId
     * @return string
     * @throws \Exception
     */
    public function download(string $videoId): string
    {
        $videoInfo = $this->getArray($this->youtubeApi->getVideoInfo($videoId));
        $filePath = $this->getLocalFile($videoInfo['snippet']['title']);

        if (!file_exists($filePath)) {
            $youtubeDownloader = new YoutubeDownloader($videoId);
            $youtubeDownloader->setPath($this->filePath);
            $youtubeDownloader->download();
        }

        return $filePath;
    }

    public function getArray($stdClass)
    {
        return json_decode(json_encode($stdClass), true);
    }

    /**
     * @param $title
     * @return string
     */
    public function getLocalFile(string $title): string
    {
        $title = str_replace(' ', '_', $title);
        $title = addslashes($title);
        return \Yii::getAlias('@files') . '/' . $title . '.webm';
    }
}