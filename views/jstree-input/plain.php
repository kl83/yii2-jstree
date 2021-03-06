<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $widget kl83\jstree\JsTreeInput */
/* @var $hasModel boolean */

$widget = $this->context;

echo Html::beginTag('div', $widget->options);

    echo Html::tag('div', '', [ 'class' => 'jstree' ]);

    if ( $hasModel ) {
        echo Html::activeHiddenInput($widget->model, $widget->attribute);
    } else {
        echo Html::hiddenInput($widget->name, $widget->value);
    }

echo Html::endTag('div');
