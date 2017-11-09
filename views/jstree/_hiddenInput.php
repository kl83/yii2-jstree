<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $widget kl83\jstree\JsTree */
/* @var $inputName string */
/* @var $value array|int */

$widget = $this->context;

if ( $widget->multiple ) {
    echo Html::beginTag('div', [ 'class' => 'hidden-wrapper' ]);
        if ( is_array($value) ) {
            foreach ( $value as $idx => $val ) {
                echo Html::hiddenInput("{$inputName}[$idx]", $val);
            }
        }
    echo Html::endTag('div');
} else {
    echo Html::hiddenInput($inputName, $value);
}
