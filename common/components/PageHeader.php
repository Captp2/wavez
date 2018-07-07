<?php

namespace common\components;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\bootstrap\ButtonGroup;
use yii\helpers\Html;

class PageHeader extends Widget
{
    //region Public Properties
    public $title = null;
    public $buttons = [];
    public $wrapperOptions = [];
    public $buttonGroupOptions = ['class' => 'pull-right'];
    public $buttonsDefault = ['tagName' => 'a', 'encodeLabel' => false];
    public $titleOptions = [];
    //endregion Public Properties

    //region Initialization
    public function init()
    {
        if ($this->title === null) {
            throw new InvalidConfigException('Title must be set');
        }

        foreach ($this->buttons as &$button) {
            $button = array_merge($this->buttonsDefault, $button);
        }
    }
    //endregion Initialization

    //region Public Methods
    public function run()
    {
        Html::addCssClass($this->wrapperOptions, 'page-header');

        echo Html::beginTag("div", $this->wrapperOptions);

        if (!empty($this->buttons)) {
            echo ButtonGroup::widget(
                [
                    'options' => $this->buttonGroupOptions,
                    'buttons' => $this->buttons,
                ]
            );
        }

        echo Html::tag("h1", $this->title, $this->titleOptions);

        echo Html::endTag("div");
    }
    //endregion Public Methods
}