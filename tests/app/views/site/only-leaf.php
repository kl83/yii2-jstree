<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yii\base\DynamicModel */

$this->title = "JsTree model";

?>
<div class="site-index">

    <h1>Select only leaf</h1>

    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'test')->widget('kl83\jstree\JsTree', [
        'selectOnlyLeaf' => true,
        'source' => [ 'site/source' ],
    ]) ?>

    <?= Html::submitButton() ?>

    <?php ActiveForm::end() ?>

</div>
