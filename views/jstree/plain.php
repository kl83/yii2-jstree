<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $widget kl83\jstree\JsTree */
/* @var $inputName string */
/* @var $value array|int */

$widget = $this->context;

echo Html::beginTag('div', $widget->options);

    echo Html::tag('div', '', [ 'class' => 'jstree' ]);

    echo $this->render('_hiddenInput', [
        'inputName' => $inputName,
        'value' => $value,
    ]);

echo Html::endTag('div');
