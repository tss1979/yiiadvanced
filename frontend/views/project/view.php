<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'author_id',
            'description:ntext',
            'created_at',
            'updated_at',
            'priority_id',
            'status',
        ],
    ]) ?>
    <?php if($model->tasks) : ?>
    <hr>
    <h2>Задачи проекта</h2>
    <?= GridView::widget([
            'dataProvider'=> $taskDataProvider,
            'filterModel'=> $taskSearchModel,
            'columns'=> [
                    ['class'=> 'yii\grid\SerialColumn'],
                    'id',
                    [
                            'attribute'=> 'author_id',
                            'value'=> function(\common\models\Task $model){
                                return $model->author_id;
                            }

                    ],
                    'name',
             ],
    ]); ?>
    <?php else : ?>
    <p> Задач нет</p>
    <?php endif; ?>


</div>
