<?php

namespace app\controllers;

use yii\rest\ActiveController;
use app\models\KategoriMenu;
use yii\web\Response;

class KategoriMenuController extends ActiveController
{

    public $modelClass = KategoriMenu::class;
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }
}
