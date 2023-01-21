<?php

namespace app\controllers;

use app\models\Menu;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\data\ActiveDataProvider;

class MenuController extends ActiveController
{
    public $modelClass = Menu::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }

}
