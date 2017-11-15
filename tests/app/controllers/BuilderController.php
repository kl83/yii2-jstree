<?php

namespace app\controllers;

class BuilderController extends \yii\web\Controller {
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionWithForm()
    {
        return $this->render('with-form');
    }
}
