<?php
/**
 * Created by PhpStorm.
 * User: sergeytashkinov
 * Date: 2019-12-20
 * Time: 19:47
 */
namespace console\commands;


use yii\console\controlers;

class ConsoleGreatingsController extends Controller
{

    public function actionIndex()
    {
        echo 'Hello, World!';
    }
}