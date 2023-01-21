<?php

namespace app\controllers;

use app\models\Meja;
use yii\rest\ActiveController;
use yii\web\Response;

class MejaController extends ActiveController
{


    public $modelClass = Meja::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }
    
}
