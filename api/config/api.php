<?php
use \yii\web\Request;
$baseUrlFrontend = str_replace('/api', '/', (new Request)->getBaseUrl());
return [
    'id' => 'app-api',
	'name' => '',

    'controllerNamespace' => 'api\controllers',

    'components' => [
		'urlManager' => [
			'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
			'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'user',
                    'extraPatterns' => [
                        'POST login' => 'login',
                        'GET log' => 'log',
                        'GET is-logged-in' => 'is-logged-in',
                        'POST logout' => 'logout',
                        'GET get-block' => 'get-block',
                        'POST set-status' => 'set-status',
                        'POST update-status' => 'update-status',
                        'POST update-duration' => 'update-duration',
                        'POST set-variable' => 'set-variable',
                        'GET set-intro-status' => 'set-intro-status',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'goals',
                    'extraPatterns' => [
                        'GET get-questions' => 'get-questions',
                        'POST save-goal' => 'save-goal',
                        'POST save-goals' => 'save-goals',
                        'GET get-rating' => 'get-rating',
                        'POST save-rating' => 'save-rating',
                        'POST search-rating' => 'search-rating',
                        'GET get-goals-rating' => 'get-goals-rating',
                        'GET get-goals-progress' => 'get-goals-progress',
                        'GET get-history' => 'get-history',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'site',
                    'extraPatterns' => [
                        'GET get-block' => 'get-block',
                        'GET get-navigation' => 'get-navigation',
                        'GET get-page-visits' => 'get-page-visits',
                        'GET search-content' => 'search-content',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'artists',
                    'extraPatterns' => [
                        'GET get-index' => 'get-index',
                        'POST get-create' => 'get-create',
                        'POST get-update' => 'get-update',
                        'POST get-delete' => 'get-delete',
                    ],
                ],
                ['class' => 'yii\rest\UrlRule','controller' => ['resource']]
			]
		],
		'urlManagerFrontEnd' => [
			'class' => 'yii\web\urlManager',
			'baseUrl' => $baseUrlFrontend,
			'enablePrettyUrl' => true,
			'showScriptName' => false,
		],
		'request' => [
            'cookieValidationKey' => 'MS-Inform',
			'parsers' => [
				'application/json' => 'yii\web\JsonParser',
			]
		],
		'response' => [
			'class' => 'yii\web\Response',
			'format' => yii\web\Response::FORMAT_JSON,
			'charset' => 'UTF-8',

		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'user' => [
			'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 1800,
        ],
        'session' => [
            'name' => 'PHPFRONTSESSID',
            'savePath' => sys_get_temp_dir(),
        ],
    ],
    'params' => [],
];
