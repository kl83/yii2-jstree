<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = "JsTree plain";

?>
<div class="site-index">

    <h1>Plain</h1>

    <?= kl83\jstree\JsTree::widget([
        'name' => 'test',
        'value' => json_encode([ 321, 111 ]),
        'source' => [ 'site/source' ],
    ]) ?>

    <?= Html::submitButton() ?>

</div>
