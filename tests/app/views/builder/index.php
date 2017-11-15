<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = "JsTreeBuider";

if ( Yii::$app->request->isPost ) {
    $value = Yii::$app->request->post('test');
} else {
    $value = json_encode([
        [
            'id' => 1,
            'parent' => '#',
            'text' => 'item 1',
        ], [
            'id' => 2,
            'parent' => '#',
            'text' => 'item 2',
        ],
    ]);
}

?>
<div class="builder-index">

    <h1>JsTreeBuider</h1>

    <form action="" method="post">

    <?= kl83\jstree\JsTreeBuilder::widget([
        'name' => 'test',
        'value' => $value,
    ]) ?>

    <br>

    <?= Html::submitButton() ?>

    </form>

</div>
