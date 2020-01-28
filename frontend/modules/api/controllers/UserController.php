<?php
/**
 * Created by PhpStorm.
 * User: sergeytashkinov
 * Date: 2020-01-24
 * Time: 00:10
 */

namespace frontend\modules\api\controllers;


use common\models\User;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = User::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            //нужно исключить action которые используются в accessFilter ACF
            'except' => ['create']
        ];

        return $behaviors;

    }
}