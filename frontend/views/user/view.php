<?php

/**
 * @var $this \yii\web\View
 * @var $model \common\models\User
 */

use yii\helpers\Html;

$this->title = $model->username;

echo Html::tag('h1', $this->title);

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