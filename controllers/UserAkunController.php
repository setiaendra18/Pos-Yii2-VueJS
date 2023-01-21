<?php

namespace app\controllers;

use app\models\UserAkun;
use yii\rest\ActiveController;
use yii\web\Response;

class UserAkunController extends ActiveController
{

    public $modelClass = UserAkun::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }
}
