<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
        ]
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager', // or use 'yii\rbac\DbManager'
        ],
        'user' => [
            // 'class' => 'mdm\admin\models\User',
            'identityClass' => 'mdm\admin\models\User',
            //'loginUrl' => ['admin/user/login'],
        ],
    //     'view' => [
    //         'theme' => [
    //             'pathMap' => [
    //                '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app',
    //             ],
    //         ],
    //    ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
            'allowActions' => [
                'site/*',
                'admin/*',
            ]
        ],
];
