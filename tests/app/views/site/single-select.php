<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yii\base\DynamicModel */

$this->title = "JsTree single select";

?>
<div class="site-index">

    <h1>Single select</h1>

    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'test')->widget('kl83\jstree\JsTree', [
        'multiple' => false,
        'source' => [ 'site/source' ],
    ]) ?>

    <?= Html::submitButton() ?>

    <?php ActiveForm::end() ?>

</div>
