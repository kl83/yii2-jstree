<?php
namespace kl83\jstree;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

class JsTree extends \yii\widgets\InputWidget
{
    /**
     * Enable multiple selections.
     * @var boolean
     */
    public $multiple = true;
    /**
     * Limit the selection of leaf nodes only.
     * @var boolean
     */
    public $selectOnlyLeaf = false;
    /**
     * Prints the button. Clicking the button displays a pop-up window with a tree.
     * @var boolean
     */
    public $popup = false;
    /**
     * URL to load JSON-data.
     * @var string
     */
    public $source;

    public function init()
    {
        WidgetAsset::register($this->view);
        parent::init();
    }

    public function run()
    {
        $this->options['class'] = 'kl83-jstree';
        $clientOptions = [
            'id' => $this->options['id'],
            'multiple' => $this->multiple,
            'selectOnlyLeaf' => $this->selectOnlyLeaf,
            'popup' => $this->popup,
            'jstree' => [
                'plugins' => [ 'checkbox' ],
                'core' => [
                    'multiple' => $this->multiple,
                    'data' => [
                        'url' => Url::to($this->source),
                    ],
                ],
                'checkbox' => [
                    'three_state' => $this->multiple,
                ],
            ],
        ];
        $this->view->registerJs("kl83InitJsTree(jQuery, ".Json::encode($clientOptions).");");
        return $this->render( $this->popup ? 'jstree/popup' : 'jstree/plain', [
            'hasModel' => $this->hasModel(),
        ]);
    }
}
