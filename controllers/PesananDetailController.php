<?php

namespace app\controllers;

use app\models\PesananDetail;
use yii\rest\ActiveController;
use yii\web\Response;



class PesananDetailController extends ActiveController
{

    public $modelClass = PesananDetail::class;

    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }
    public function prepareDataProvider()
    {
        $query = PesananDetail::find();
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);

        return $dataProvider;
    }
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }
}
