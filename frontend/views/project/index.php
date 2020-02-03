<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Priority;
use common\models\User;


/* @var $this yii\web\View */
/* @var $searchModel frontend\search\SearchProject */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать проект', ['create'], ['class' => 'btn btn-success']) ?>
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
                'value'=>function($searchModel)
                {
                    $user = User::findOne($searchModel->author_id);
                    return $user->username;
                }
            ],
            'description:ntext',
            [
                'attribute'=>'created_at',
                'value'=>function($searchModel)
                {
                    return Yii::$app->formatter->asDatetime($searchModel->created_at);
                }
            ],
            [
                'attribute'=>'updated_at',
                'value'=>function($searchModel)
                {
                    return Yii::$app->formatter->asDatetime($searchModel->updated_at);
                }
            ],
            [
                'attribute'=>'priority_id',
                'value'=> function($searchModel)
                {
                    $priority = Priority::findOne($searchModel->priority_id);
                    return $priority->name;
                }

            ],
            [
                'attribute'=>'status',
                'value'=> $searchModel->getStatusName($searchModel->status)

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
