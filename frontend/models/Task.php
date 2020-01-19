<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property int $author_id
 * @property int $implementer_id
 * @property string $description
 * @property int $deadline
 * @property int $priority_id
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $author
 * @property User $implementer
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const STATUS_NEW = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_DONE = 3;

    public static function tableName()
    {
        return 'task';
    }

    public function behaviors()
    {
        return [TimestampBehavior::class => ['class'=>TimestampBehavior::class]];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'author_id', 'implementer_id', 'description', 'deadline', 'created_at', 'updated_at'], 'required'],
            [['author_id', 'implementer_id', 'created_at', 'updated_at', 'priority_id','project_id'], 'integer'],
            ['deadline', 'safe'],
          //  ['author_id', 'default', 'value'=> \Yii::$app->user->identity->getId()],
            [['name', 'description', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Порядковый номер',
            'name' => 'Название',
            'author_id' => 'Инициатор',
            'implementer_id' => 'Исполнитель',
            'description' => 'Описание',
            'priority_id'=> 'Приоритет',
            'project_id'=> 'Проект',
            'status'=> 'Статус',
            'deadline' => 'Срок завершения',
            'created_at' => 'Задание создано',
            'updated_at' => 'Задание обновлено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImplementer()
    {
        return $this->hasOne(User::className(), ['id' => 'implementer_id']);
    }

    public function getProject()
    {
        return $this->hasOne(Project::class, ['id'=> 'project_id']);
    }

    public static function getStatusName()
    {
        return [
            static::STATUS_NEW => 'Новый',
            static::STATUS_IN_PROGRESS =>'В процессе',
            static::STATUS_DONE => 'Завершен',
        ];
    }

    public function getStatus($value){
        switch($value){
            case 1:
                return 'Новый';
            case 2:
                return 'В процессе';
            case 3:
                return 'Завершен';
        }


    }

    public function getPriority()
    {
        return $this->hasOne(Priorty::class, ['id' =>'priority_id'])->where(['priority.type'=>Priority::TYPE_TASK]);
    }
}
