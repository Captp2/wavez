<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Playlist */

$this->title = $model->label;

try {
    echo \common\components\PageHeader::widget([
        'title' => $this->title,
        'buttons' => [
            [
                'label' => 'Update',
                'options' => [
                    'href' => Url::to(['playlist/update', 'id' => $model->id]),
                    'class' => 'btn btn-primary',
                ]
            ],
            [
                'label' => 'Delete',
                'options' => [
                    'href' => Url::to(['playlist/delete', 'id' => $model->id]),
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]
            ]
        ]
    ]);
} catch (Exception $e) {
    Yii::error($e->getMessage());
}

try {
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'created_at:datetime',
            'updated_at:datetime',
            'label',
        ],
    ]);
} catch (Exception $e) {
    Yii::error($e->getMessage());
}

