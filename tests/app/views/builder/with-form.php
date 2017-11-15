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

    <h1>JsTreeBuider with linked form</h1>

    <form action="" method="post">

        <div style="float: left; width: 400px;">
            <h2 style="margin-top: 0">jsTree</h2>
            <?= kl83\jstree\JsTreeBuilder::widget([
                'name' => 'test',
                'value' => $value,
                'linkForm' => '#node-settings',
            ]) ?>
        </div>

        <div id="node-settings" style="float: left; width: 400px;">
            <h2>Node settings</h2>
            <p><?= Html::textInput('text-param-1') ?></p>
            <p><?= Html::checkbox('checkbox-param') ?></p>
            <p><?= Html::dropDownList('dropdown', null, [ '0' => '---------', '1' => 'option one', '2' => 'option two' ]) ?></p>
        </div>

        <div style="clear: left; padding: 15px 0 0">
            <?= Html::submitButton() ?>
        </div>

    </form>

    

</div>
