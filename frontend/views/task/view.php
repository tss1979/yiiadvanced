<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;
use common\models\Priority;
use common\models\Project;

/* @var $this yii\web\View */
/* @var $model frontend\models\Task */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<b class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::a("Проект $project->name", ['project/view', 'id' => $model->project_id], ['class' => 'btn btn-info']) ?><br>
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
