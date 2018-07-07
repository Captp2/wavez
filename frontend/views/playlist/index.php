<?php

use common\components\PageHeader;
use common\models\Playlist;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Playlists';

try {
    echo PageHeader::widget([
        'title' => $this->title,
        'buttons' => [
            [
                'label' => 'Create',
                'options' => ['href' => Url::to(['playlist/create']), 'class' => 'btn btn-blue'],
            ],
        ]]);
} catch (Exception $e) {
    Yii::error($e->getMessage());
}

try {
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions'   => function (Playlist $model) {
            $options = [
                'onclick' => 'location.href="'.Url::to(['playlist/view', 'id' => $model->id]).'"',
                'style'   => 'cursor: pointer;',
            ];

            return $options;
        },
        'columns' => [
            'created_at:datetime',
            'updated_at:datetime',
            'label',
        ],
    ]);
} catch (Exception $e) {
    Yii::error($e->getMessage());
}