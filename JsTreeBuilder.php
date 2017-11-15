<?php

namespace kl83\jstree;

use Yii;
use yii\helpers\Json;

class JsTreeBuilder extends \yii\widgets\InputWidget {
    use TranslationTrait;

    /**
     * CSS-selector of container with input tags to edit additional data of nodes
     * @var string
     */
    public $linkForm;

    public function getClientOptions()
    {
        return [
            'id' => $this->options['id'],
            'linkForm' => $this->linkForm,
            'renamePrompt' => Yii::t('kl83/jstree', 'Enter new label'),
            'addPrompt' => Yii::t('kl83/jstree', 'Enter new node label'),
            'addText' => Yii::t('kl83/jstree', 'New node'),
        ];
    }

    public function run() {
        $this->registerTranslations();
        JsTreeBuilderAsset::register($this->view);
        if ( isset($this->options['class']) ) {
            $this->options['class'] .= ' kl83-jstree-builder';
        } else {
            $this->options['class'] = 'kl83-jstree-builder';
        }
        $this->view->registerJs('kl83InitJsTreeBuilder('.Json::encode($this->clientOptions).');');
        return $this->render('jstree-builder', [
            'hasModel' => $this->hasModel(),
        ]);
    }
}
