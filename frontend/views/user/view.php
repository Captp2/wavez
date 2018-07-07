<?php

/**
 * @var $this \yii\web\View
 * @var $model \common\models\User
 */

use common\components\PageHeader;
use yii\helpers\Url;

$this->title = $model->username;

try {
    echo PageHeader::widget([
        'title' => $this->title,
        'buttons' => [
            [
                'label' => 'Update',
                'options' => ['href' => Url::to(['user/update', 'id' => $model->id]), 'class' => 'btn btn-blue'],
            ],
        ]]);
} catch (Exception $e) {
}

try {
    echo \yii\widgets\DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email',
            'created_at:datetime',
            'updated_at:datetime',
        ]
    ]);
} catch (Exception $e) {
    echo $e->getMessage();
}