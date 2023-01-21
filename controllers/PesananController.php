<?php

namespace app\controllers;
use yii\web\Response;
use app\models\Pesanan;
use yii\rest\ActiveController;


class PesananController extends ActiveController
{
    
    public $modelClass =Pesanan::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }
    
}
