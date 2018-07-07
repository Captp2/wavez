<?php

namespace common\services;

use Madcoda\Youtube\Youtube;
use Masih\YoutubeDownloader\YoutubeDownloader;
use yii\base\Component;

class YoutubeService extends Component
{
    /** @var Youtube */
    public $youtubeApi;

    /**
     * @throws \Exception
     */
    public function init()
    {
        $this->youtubeApi = new Youtube(['key' => 'AIzaSyBmHXvBqZrf6jEjC3iwdJD3-j1-kkefjCM']);
    }

    public function search(string $search)
    {
        return json_decode(json_encode($this->youtubeApi->search($search)), true);
    }
}