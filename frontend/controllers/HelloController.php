<?php
/**
 * Created by PhpStorm.
 * User: sergeytashkinov
 * Date: 2019-12-20
 * Time: 20:32
 */

namespace frontend\controllers;

use yii\web\Controller;
use Yii;

class HelloController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}