<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $widget kl83\jstree\JsTreeBuilder */
/* @var $hasModel boolean */

$widget = $this->context;

echo Html::beginTag('div', $widget->options);

    echo Html::tag('div', '', [ 'class' => 'jstree' ]);

    echo Html::beginTag('div', [ 'class' => 'jstree-buttons' ]);
        echo Html::button(Yii::t('kl83/jstree', 'Add node'), [ 'class' => 'add-node btn btn-default' ]);
        echo Html::button(Yii::t('kl83/jstree', 'Rename node'), [ 'class' => 'rename-node btn btn-default' ]);
        echo Html::button(Yii::t('kl83/jstree', 'Remove node'), [ 'class' => 'remove-node btn btn-default' ]);
    echo Html::endTag('div');

    if ( $hasModel ) {
        echo Html::activeHiddenInput($widget->model, $widget->attribute);
    } else {
        echo Html::hiddenInput($widget->name, $widget->value);
    }

echo Html::endTag('div');
