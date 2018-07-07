<?php

/**
 * @var $this \yii\web\View
 * @var $model \common\models\User
 */

use common\components\PageHeader;
use yii\widgets\ActiveForm;

$this->title = $model->username;

try {
    echo PageHeader::widget([
        'title' => $this->title
    ]);
} catch (Exception $e) {
    echo $e->getMessage();
}

$form = ActiveForm::begin();
echo $form->errorSummary($model);

echo $form->field($model, 'username')->textInput();
echo $form->field($model, 'email')->textInput();

echo \yii\helpers\Html::submitButton('Update', ['class' => 'btn btn-blue']);

$form::end();