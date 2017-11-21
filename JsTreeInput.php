<?php
namespace kl83\jstree;

use yii\helpers\Json;
use yii\helpers\Url;

class JsTreeInput extends \yii\widgets\InputWidget
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
     * Limit the selection by specified depth.
     * @var integer
     */
    public $selectOnlyDepth;
    /**
     * Prints the button. Clicking the button displays a pop-up window with a tree. 1 is root nodes.
     * @var boolean
     */
    public $popup = false;
    /**
     * URL to load JSON-data.
     * @var string
     */
    public $source;

    public function getClientOptions()
    {
        return [
            'id' => $this->options['id'],
            'multiple' => $this->multiple,
            'selectOnlyLeaf' => $this->selectOnlyLeaf,
            'selectOnlyDepth' => $this->selectOnlyDepth,
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
    }

    public function run()
    {
        JsTreeInputAsset::register($this->view);
        if ( isset($this->options['class']) ) {
            $this->options['class'] .= ' kl83-jstree-input';
        } else {
            $this->options['class'] = 'kl83-jstree-input';
        }
        $this->view->registerJs("kl83InitJsTreeInput(jQuery, ".Json::encode($this->clientOptions).");");
        return $this->render( $this->popup ? 'jstree-input/popup' : 'jstree-input/plain', [
            'hasModel' => $this->hasModel(),
        ]);
    }
}
