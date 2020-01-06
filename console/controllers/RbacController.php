<?php
/**
 * Created by PhpStorm.
 * User: sergeytashkinov
 * Date: 2019-12-28
 * Time: 00:01
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\componrnts\rbac\UserRoleRule;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        $dashboard = $auth->createPermission('adminPanel');
        $dashboard->description = 'Админ';
        $auth->add($dashboard);

        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        $auth->add($user);

        $admin = $auth->createRole('admin');
        $admin->description = 'Админ';
        $auth->add($admin);

        $auth->addChild($admin, $user);

    }
}