<?php

namespace app\controllers;

use Yii;
use yii\base\DynamicModel;

class SiteController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    private function prepareModel()
    {
        $model = new DynamicModel([
            'test' => null,
        ]);
        $model->addRule('test', 'safe');
        if ( Yii::$app->request->isPost ) {
            $model->load(Yii::$app->request->post());
        }
        return $model;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionModel()
    {
        $model = $this->prepareModel();
        return $this->render('model', [
            'model' => $model,
        ]);
    }

    public function actionSingleSelect()
    {
        $model = $this->prepareModel();
        return $this->render('single-select', [
            'model' => $model,
        ]);
    }

    public function actionOnlyLeaf()
    {
        $model = $this->prepareModel();
        return $this->render('only-leaf', [
            'model' => $model,
        ]);
    }

    public function actionPopup()
    {
        $model = $this->prepareModel();
        return $this->render('popup', [
            'model' => $model,
        ]);
    }

    public function actionSource()
    {
        return $this->asJson([
            [
                'id' => 123,
                'parent' => '#',
                'text' => '123',
            ], [
                'id' => 321,
                'parent' => '#',
                'text' => '321',
            ], [
                'id' => 111,
                'parent' => 123,
                'text' => 'child 1',
            ], [
                'id' => 112,
                'parent' => 123,
                'text' => 'child 2',
            ]
        ]);
    }
}
