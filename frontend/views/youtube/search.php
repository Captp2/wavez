<?php

/**
 * @var $this \yii\web\View
 * @var $search null|string
 * @var $results array
 */

use common\components\PageHeader;
use common\components\YoutubeGridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Search';

try {
    echo PageHeader::widget(['title' => $this->title]);
} catch (Exception $e) {
    echo $e->getMessage();
}

$form = ActiveForm::begin(['method' => 'GET']);

echo Html::textInput('search', $search, ['class' => 'form-control']);

$form::end();

try {
    echo YoutubeGridView::widget(['collection' => $results]);
} catch (Exception $e) {
    echo $e->getMessage();
}