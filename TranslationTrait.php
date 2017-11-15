<?php

namespace kl83\jstree;

use Yii;

trait TranslationTrait {
    public function registerTranslations()
    {
        $i18n = Yii::$app->i18n;
        $i18n->translations['kl83/jstree'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => __DIR__ . "/messages",
            'fileMap' => [
                'kl83/jstree' => 'jstree.php',
            ],
        ];
    }

}
