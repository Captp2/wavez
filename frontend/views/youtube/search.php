<?php

/**
 * @var $this \yii\web\View
 * @var $search null|string
 */

use common\components\PageHeader;
use yii\base\DynamicModel;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Search';

try {
    echo PageHeader::widget(['title' => $this->title]);
} catch (Exception $e) {
    echo $e->getMessage();
}

$form = ActiveForm::begin(['method' => 'GET']);

echo Html::textInput('search', $search, ['class' => 'form-control']);
echo Html::submitButton('Search');

$form::end();