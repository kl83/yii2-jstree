<?php

namespace kl83\jstree;

class JsTreeBuilderAsset extends \yii\web\AssetBundle {
    public $sourcePath = __DIR__ . "/dist/web" ;
    public $depends = [
        'kl83\jstree\JsTreeAsset',
    ];
    public $js = [
        'js/jstree-builder.js',
    ];
    public $css = [
        'css/jstree-builder.css',
    ];
}
