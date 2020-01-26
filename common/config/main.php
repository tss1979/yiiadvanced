<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',

        ],
        'formatter'=>[
            'dateFormat' => 'php:d-m-Y',
            'datetimeFormat' => 'php:d-m-Y H:i',
            'timeFormat' => 'php:H:i:s',
            'timeZone' => 'Europe/Moscow',
        ],
        'authManager'=>[
            'class'=>'yii\rbac\PhpManager',
            'itemFile'=> '@common/components/rbac/items.php',
            'assignmentFile'=>'@common/components/rbac/assignments.php',
            'ruleFile'=>'@common/components/rbac/rules.php'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
];
