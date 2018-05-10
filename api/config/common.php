<?php
Yii::setAlias('api', dirname(__DIR__));
$params = require(__DIR__ . '/params.php');
$config =  [
    'basePath' => dirname(__DIR__),
	'timeZone' => 'America/New_York',
	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'bootstrap' => ['log'],

    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'GeneralFunctions' => [
            'class' => 'common\components\GeneralFunctions'
        ],
    ],
    'params' => $params,
];

/*
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}*/

return $config;
