<?php

namespace kl83\jstree;

class JsTreeInputAsset extends \yii\web\AssetBundle {
    public $sourcePath = __DIR__ . "/dist/web" ;
    public $depends = [
        'kl83\jstree\JsTreeAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $js = [
        'js/jstree.js',
    ];
    public $css = [
        'css/jstree.css',
    ];
}
