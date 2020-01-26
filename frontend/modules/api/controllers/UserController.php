<?php
/**
 * Created by PhpStorm.
 * User: sergeytashkinov
 * Date: 2020-01-24
 * Time: 00:10
 */

namespace frontend\modules\api\controllers;


use common\models\User;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = User::class;
}