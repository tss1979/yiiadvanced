<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

class ChatController extends Controller
{
    public function behaviors()
    {
        return [
            'access'=> [
                'class'=> AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}