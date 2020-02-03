<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use frontend\behaviors\ChatNotificationBehavior;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $author_id
 * @property string|null $description
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $priority_id
 * @property string|null $status
 *
 * @property Priority $priority
 * @property User $author
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const STATUS_NEW = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_DONE = 3;

    public function behaviors()
    {
        return [
            TimestampBehavior::class => ['class'=>TimestampBehavior::class],
            [
                'class' => ChatNotificationBehavior::class,
            ],

        ];
    }

    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'created_at', 'updated_at', 'priority_id'], 'integer'],
            [['description'], 'string'],
            [['name', 'status'], 'string', 'max' => 255],
            [['priority_id'], 'exist', 'skipOnError' => true, 'targetClass' => Priority::className(), 'targetAttribute' => ['priority_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
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
            'author_id' => 'Автор',
            'description' => 'Описание',
            'created_at' => 'Время создания',
            'updated_at' => 'Время обновления',
            'priority_id' => 'Приоритет',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriority()
    {
        return $this->hasOne(Priority::class, ['id' => 'priority_id', 'type'=>Priority::TYPE_PROJECT]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }
    
    public function getTasks()
    {
        return $this->hasMany(Task::class, ['project_id'=> 'id']);
    }

    public static function getProjects()
    {
        return ArrayHelper::map(
            self::find()
                ->asArray()
                ->orderBy('id')
                ->all(),
            'id',
            'name');
    }

    public static function getStatus()
    {
        return [
            static::STATUS_NEW => 'Новый',
            static::STATUS_IN_PROGRESS =>'В процессе',
            static::STATUS_DONE => 'Завершен',
        ];
    }

    public function getStatusName($value)
    {
        switch ($value) {
            case 1:
                return 'Новый';
            case 2:
                return 'В процессе';
            case 3:
                return 'Завершен';
        }

    }
}
