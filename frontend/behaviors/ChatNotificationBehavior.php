<?php
/**
 * Created by PhpStorm.
 * User: sergeytashkinov
 * Date: 2020-01-24
 * Time: 00:25
 */

namespace frontend\behaviors;

use common\models\Project;
use common\models\Task;
use common\models\User;
use frontend\models\ChatLog;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class ChatNotificationBehavior extends Behavior
{
    const MODE_INSERT = 0;
    const MODE_UPDATE = 1;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'sendInsertNotification',
            ActiveRecord::EVENT_AFTER_UPDATE => 'sendUpdateNotification'
        ];
    }

    public function sendInsertNotification() {
        $this->sendNotification(self::MODE_INSERT);
    }

    public function sendUpdateNotification() {
        $this->sendNotification(self::MODE_UPDATE);
    }

    private function sendNotification( $mode = self::MODE_INSERT ) {
        $model = $this->owner;
        /** @var $model Task|Project */
        $creator = User::findOne([ 'id' => $model->author_id ?? null ]);

        $currentDateTime = date('d-m-Y H:i');
        $chatLogBody = [];
        if ( $model instanceof Project ) {
            $message = $mode === self::MODE_INSERT ? 'создан' : 'обновлен';
            $chatLogBody = [
                "project_id" => $model->id,
                "message" => "Проект {$model->name} {$message} {$currentDateTime}",
                "username" => (User::findOne(['id'=> $creator->id]))->username,
                "type" => 1
            ];
        } elseif ( $model instanceof Task ) {
            $message = $mode === self::MODE_INSERT ? 'создана' : 'обновлена';
            $chatLogBody = [
                "task_id" => $model->id,
                "project_id" => $model->project_id,
                "message" => "Задача {$model->name} {$message} {$currentDateTime}",
                "username" => (User::findOne(['id'=> $creator->id]))->username,
                "type" => 1
            ];
        }
        ChatLog::create($chatLogBody);
    }
}