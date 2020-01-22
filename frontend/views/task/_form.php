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

    <?php $form = ActiveForm::begin();
    $users = User::find()->all();
    $items = ArrayHelper::map($users, 'id', 'username');
    $params = [
        'prompt' => 'Укажите имя исполнителя'
    ];?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_id')->dropDownList(\common\models\Project::getProjects())?>

    <?= $form->field($model, 'author_id')->textInput() ?>

    <?= $form->field($model, 'implementer_id')->dropDownList($items, $params)?>

    <?= $form->field($model, 'status')->dropDownList(\common\models\Task::getStatusName())?>

    <?= $form->field($model, 'priority_id')->dropDownList(\common\models\Priority::getTaskPriorities())?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

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
