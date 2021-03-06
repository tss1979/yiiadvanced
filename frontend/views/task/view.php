<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;
use common\models\Priority;
use common\models\Project;

/* @var $this yii\web\View */
/* @var $isSubscribed boolean */
/* @var $model common\models\Task */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a("Проект $project->name", ['project/view', 'id' => $model->project_id], ['class' => 'btn btn-info']) ?><br>
    </p>
    <p>
        <?php
        if($model->author_id == Yii::$app->user->identity->getId()){
            echo Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить это задание?',
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>
    <p>
         <?php
             if(!$isSubscribed) {
                 echo Html::a("Подписаться", ['subscribe', 'id' => $model->id], ['class' => 'btn btn-info']);
             } else  {
                  echo Html::a("Отписаться", ['unsubscribe', 'id' => $model->id], ['class' => 'btn btn-danger']);
          }?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                    'attribute'=>'project_id',
                'value'=>function($model)
                {
                    $project = Project::findOne($model->project_id);
                    return $project->name;
                }
            ],
            [
                'attribute'=>'implementer_id',
                'value'=>function($model)
                {
                    $user = User::findOne($model->implementer_id);
                    return $user->username;
                }
            ],
            [
                'attribute'=>'status',
                'value'=> $model->getStatus($model->status)

            ],
            [
                'attribute'=>'priority_id',
                'value'=> function($model)
                {
                    $priority = Priority::findOne($model->priority_id);
                    return $priority->name;
                }

            ],
            'description',
            [
                'attribute'=>'deadline',
                'value'=>function($model)
                {
                    return Yii::$app->formatter->asDatetime($model->deadline);
                }
            ],
            [
                'attribute'=>'created_at',
                'value'=>function($model)
                {
                    return Yii::$app->formatter->asDatetime($model->created_at);
                }
            ],
            [
                'attribute'=>'updated_at',
                'value'=>function($model)
                {
                    return Yii::$app->formatter->asDatetime($model->updated_at);
                }
            ],
        ],
    ]) ?>

    </div>
<?= \frontend\widgets\chat\Chat::widget(['task_id' => $model->id]) ?>