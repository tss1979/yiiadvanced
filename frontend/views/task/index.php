<?php

use yii\helpers\Html;
use common\models\User;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\search\SearchTask */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute'=>'author_id',
                'format' => 'raw',
                'value'=>function($searchModel)
                {
                    $user = User::findOne($searchModel->author_id);
                    return $user->username;
                }

            ],
            [
                'attribute'=>'implementer_id',
                'format' => 'raw',
                'value'=>function($searchModel)
                {
                    $user = User::findOne($searchModel->implementer_id);
                    return $user->username;
                }

            ],
            'description',
            [
                'attribute'=>'deadline',
                'filter'=>\kartik\date\DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'deadline',
                    'language'=>'ru',
                    'pluginOptions'=>[
                        'autoclose'=> true,
                        'todayHighlight'=>true,
                        'format'=>'dd.mm.yyyy',
                    ],
                ]),
                'value'=>function($searchModel)
                {
                    return Yii::$app->formatter->asDatetime($searchModel->deadline);
                }

            ],
            [
                'attribute'=>'created_at',
                'filter'=>\kartik\date\DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'created_at',
                    'language'=>'ru',
                    'pluginOptions'=>[
                        'autoclose'=> true,
                        'todayHighlight'=>true,
                        'format'=>'dd.mm.yyyy',
                    ],
                ]),
                'value'=>function($searchModel)
                {
                    return Yii::$app->formatter->asDatetime($searchModel->created_at);
                }

            ],
            [
                'attribute'=>'updated_at',
                'filter'=>\kartik\date\DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'updated_at',
                    'language'=>'ru',
                    'pluginOptions'=>[
                        'autoclose'=> true,
                        'todayHighlight'=>true,
                        'format'=>'dd.mm.yyyy',
                    ],
                ]),
                'value'=>function($searchModel)
                {
                    return Yii::$app->formatter->asDatetime($searchModel->created_at);
                }

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
