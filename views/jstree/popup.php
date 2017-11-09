<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $widget kl83\jstree\JsTree */
/* @var $inputName string */
/* @var $value array|int */

$widget = $this->context;

$popupId = "{$widget->options['id']}-popup";

echo Html::beginTag('div', $widget->options);

    echo Html::tag('div', '', [ 'class' => 'selected-items' ]);

    Modal::begin([
        'id' => $popupId,
        'closeButton' => false,
        'toggleButton' => [ 'label' => Yii::t('yii', 'View'), 'class' => 'btn btn-default' ],
    ]);

        echo Html::tag('div', '', [ 'class' => 'jstree' ]);

        echo $this->render('_hiddenInput', [
            'inputName' => $inputName,
            'value' => $value,
        ]);

    Modal::end();

echo Html::endTag('div');
