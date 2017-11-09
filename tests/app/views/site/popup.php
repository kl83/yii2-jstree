<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yii\base\DynamicModel */

$this->title = "JsTree popup";

?>
<div class="site-index">

    <h1>Popup</h1>

    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'test')->widget('kl83\jstree\JsTree', [
        'popup' => true,
        'source' => [ 'site/source' ],
    ]) ?>

    <?= Html::submitButton() ?>

    <?php ActiveForm::end() ?>

</div>
