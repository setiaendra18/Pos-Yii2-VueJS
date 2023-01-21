<?php

namespace app\controllers;

use yii\rest\ActiveController;
use app\models\KategoriPesan;
use yii\web\Response;

class KategoriPesanController extends ActiveController
{
   
    public $modelClass = KategoriPesan::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }

}
