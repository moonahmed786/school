<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'modules' => [],
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
              ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'loginUrl' => null,
			'enableSession' => false
            // 'enableAutoLogin' => false,
            // 'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        // 'session' => [
        //     // this is the name of the session cookie used for login on the frontend
        //     'name' => 'advanced-frontend',
        // ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        // 'request' => [
        //     'baseUrl' => '',
        // ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            // 'rules' => [
            // ],
            // 'rules' => [
            //     '' => 'site/index',                                
            //     '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            // ],
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'artists'],
                // ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
              ],
        ],
    ],
    'params' => $params,
];
