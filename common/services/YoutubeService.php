<?php

namespace common\services;

use common\models\File;
use Madcoda\Youtube\Youtube;
use Masih\YoutubeDownloader\YoutubeDownloader;
use Ramsey\Uuid\Uuid;
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
    public function download(string $videoId): array
    {
        $videoInfo = $this->getArray($this->youtubeApi->getVideoInfo($videoId));
        var_dump($videoInfo);
        exit;
        $fileName = $this->getFileName($videoInfo['snippet']['title']);

        if (!$file = File::fileName($fileName)->one()) {
            $file = new File();
            $file->file_name = $fileName;
            $filePath = Uuid::uuid1();
            $file->file_path = $this->getFilePath($filePath);

            $youtubeDownloader = new YoutubeDownloader($videoId);
            $youtubeDownloader->sanitizeFileName = function ($fileName) use ($youtubeDownloader, $filePath) {
                return $filePath;
            };

            $youtubeDownloader->setPath($this->filePath);
            $youtubeDownloader->download();

            $file->save();
        }

        return ['fileName' => $file->file_name, 'filePath' => $file->file_path];
    }

    public function getArray($stdClass)
    {
        return json_decode(json_encode($stdClass), true);
    }

    /**
     * @param $title
     * @return string
     */
    public function getFileName(string $title): string
    {
        return str_replace(' ', '_', $title);
    }

    public function getFilePath(string $path): string
    {
        return \Yii::getAlias('@files') . '/' . $path . '.webm';
    }
}