<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yii\base\DynamicModel */

$this->title = "JsTreeInput model";

?>
<div class="site-index">

    <h1>Select only depth 2</h1>

    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'test')->widget('kl83\jstree\JsTreeInput', [
        'selectOnlyDepth' => 2,
        'source' => [ 'site/source' ],
    ]) ?>

    <?= Html::submitButton() ?>

    <?php ActiveForm::end() ?>

</div>
