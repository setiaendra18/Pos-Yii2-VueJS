<?php

namespace app\controllers;

use app\models\MenuTerjual;
use yii\rest\ActiveController;
use yii\web\Response;

class MenuTerjualController extends ActiveController
{

    public $modelClass = MenuTerjual::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }
}
