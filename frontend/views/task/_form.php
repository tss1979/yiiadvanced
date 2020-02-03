<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\jui\DatePicker;
use common\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin();?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_id')->dropDownList(\common\models\Project::getProjects())?>

    <?= $form->field($model, 'author_id')->textInput(['value'=>Yii::$app->user->getId()]) ?>

    <?= $form->field($model, 'implementer_id')->dropDownList(ArrayHelper::map((User::find()->where(['>', 'id', 1])->all()), 'id', 'username'))?>

    <?= $form->field($model, 'status')->dropDownList(\common\models\Task::getStatusName())?>

    <?= $form->field($model, 'priority_id')->dropDownList(\common\models\Priority::getTaskPriorities())?>

    <?= $form->field($model, 'description')->textarea() ?>

    <?= $form->field($model,'deadline')->widget(DateTimePicker::class, [
        'language' => 'ru',
        'options' => [
            'convertFormat'=> false,
            'autocomplete'=>'off'
        ],
        'pluginOptions' => [
            'format'=> 'dd-mm-yyyy H:i',
            'startDate'=> '01-01-2020 00:00',
            'todayHighlight'=> true,
1
        ],
    ]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
