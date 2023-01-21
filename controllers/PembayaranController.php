<?php

namespace app\controllers;

use app\models\Pembayaran;
use yii\rest\ActiveController;
use yii\web\Response;

class PembayaranController extends ActiveController
{
 
    public $modelClass = Pembayaran::class;   

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }
    
}
