<?php

/* @var $this \yii\web\View */

/* @var $content string */

use kartik\sidenav\SideNav;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php
    echo Html::beginTag('div', ['class' => 'col-sm-3 sidebar']);
    try {
        echo SideNav::widget([
            'type' => SideNav::TYPE_PRIMARY,
            'heading' => 'Options',
            'items' => [
                [
                    'url' => '/wavez',
                    'label' => 'Home',
                    'icon' => 'home'
                ],
                [
                    'label' => Yii::$app->user->identity->username,
                    'icon' => 'user',
                    'items' => [
                        ['label' => 'Profil', 'url' => Url::to(['user/view', 'id' => Yii::$app->user->id])],
                    ],
                ],
                [
                    'label' => 'Wavez',
                    'icon' => 'headphones',
                    'items' => [
                        ['label' => 'Search', 'icon' => 'search', 'url' => Url::to(['music/search'])],
                        ['label' => 'Playlists', 'icon' => 'bookmark', 'url' => Url::to(['playlist'])],
                    ]
                ]
            ],
            'containerOptions' => ['style' => 'height:100vh;position:absolute;width:20em;margin-left:0;border-radius:0;border:0;left:0;'],
            'headingOptions' => ['style' => 'border-radius:0'],
        ]);
    } catch (Exception $e) {
        Yii::error($e->getMessage());
    }
    echo Html::endTag('div');
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
