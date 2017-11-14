<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $widget kl83\jstree\JsTreeInput */
/* @var $hasModel boolean */

$widget = $this->context;

$popupId = "{$widget->options['id']}-popup";

echo Html::beginTag('div', $widget->options);

    echo Html::beginTag('div', [ 'class' => 'selected-items' ]);
        echo Html::tag('span', Yii::t('yii', '(not set)'), [ 'class' => 'not-set-text' ]);
        echo Html::tag('span', '', [ 'class' => 'items-text' ]);
    echo Html::endTag('div');

    Modal::begin([
        'id' => $popupId,
        'closeButton' => false,
        'toggleButton' => [ 'label' => Yii::t('yii', 'View'), 'class' => 'btn btn-default' ],
    ]);

        echo Html::tag('div', '', [ 'class' => 'jstree' ]);

        if ( $hasModel ) {
            echo Html::activeHiddenInput($widget->model, $widget->attribute);
        } else {
            echo Html::hiddenInput($widget->name, $widget->value);
        }

    Modal::end();

echo Html::endTag('div');
