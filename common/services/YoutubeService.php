<?php

namespace common\services;

use common\models\File;
use Madcoda\Youtube\Youtube;
use Masih\YoutubeDownloader\YoutubeDownloader;
use Masih\YoutubeDownloader\YoutubeException;
use Ramsey\Uuid\Uuid;
use yii\base\Component;

class YoutubeService extends Component
{
    /** @var Youtube */
    public $youtubeApi;
    /** @var string */
    public $filePath;
    /** @var File */
    public $activeFile;

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
        $fileName = $this->getFileName($videoInfo['snippet']['title']);

        if (!$this->activeFile = File::fileName($fileName)->one()) {
            $this->activeFile = new File();
            $this->activeFile->file_name = $fileName;
            $filePath = Uuid::uuid1();

            $youtubeDownloader = new YoutubeDownloader($videoId);
            $youtubeDownloader->sanitizeFileName = function ($fileName) use ($youtubeDownloader, $filePath) {
                return $filePath;
            };

            $youtubeDownloader->onFinalized = function ($fileName, $fileSize, $index, $count) use ($filePath) {
                $explode = explode('.', $fileName);
                $this->activeFile->file_path .= $filePath . '.' . end($explode);
            };


            $youtubeDownloader->setPath($this->filePath);
//            try {
            $youtubeDownloader->download();
//            } catch (YoutubeException $e) {
//                if ($e->getMessage() === 'An error occurred when downloading video') {
//                    $this->download($videoId);
//                }
//            }

            $this->activeFile->save();
        }

        return ['fileName' => $this->activeFile->file_name, 'filePath' => $this->activeFile->file_path];
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