<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "priority".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $order
 * @property int|null $type
 *
 * @property Project[] $projects
 */
class Priority extends \yii\db\ActiveRecord
{
    const TYPE_PROJECT = 1;
    const TYPE_TASK = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'priority';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order'], 'string'],
            [['type'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'order' => 'Order',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['priority_id' => 'id']);
    }

    public static function getTaskPriorities()
    {
        return ArrayHelper::map(
            self::find()
            ->where([
                'type'=> self::TYPE_TASK
            ])
            ->asArray()
            ->orderBy('order')
            ->all(),
            'id',
            'name');
    }
}
