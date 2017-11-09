<?php
namespace kl83\jstree;

class JsTreeAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@bower/jstree/dist';

    public $depends = [
        'yii\web\JqueryAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $min = YII_DEBUG ? '' : '.min';
        $this->css = [
            "themes/default/style$min.css",
        ];
        $this->js = [
            "jstree$min.js",
        ];
        parent::init();
    }
}
