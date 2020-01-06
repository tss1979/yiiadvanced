<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property int $author_id
 * @property int $implementer_id
 * @property string $description
 * @property int $deadline
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
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'author_id', 'implementer_id', 'description', 'deadline', 'created_at', 'updated_at'], 'required'],
            [['author_id', 'implementer_id', 'deadline', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'author_id' => 'Author ID',
            'implementer_id' => 'Implementer ID',
            'description' => 'Description',
            'deadline' => 'Deadline',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
}
