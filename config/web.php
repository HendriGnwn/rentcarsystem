<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'rentcarsystem',
    'name' => 'Rent Car System',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'uLA1OXnJh9QHb4ImAN29Wymwz4_rPHXh',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
			'identityClass' => 'mdm\admin\models\User',
			'enableAutoLogin' => true,
			'enableSession' => true,
			'authTimeout' => 60 * 60, /* 1 hour */
		],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'authManager' => [
			'class' => 'app\components\DbManager',
			'defaultRoles' => ['guest'], //role biasa
		],
        
        'urlManager'  => require(__DIR__ . '/url-manager.php'),
        
        'assetManager' => [
			'bundles' => [
				'dmstr\web\AdminLteAsset' => [
					'skin' => 'skin-blue-light',
				],
			],
		],
		'view' => [
			'class' => 'app\components\View',
			'theme' => [
				'pathMap' => [
					'@app/views' => '@app/themes/adminlte/views',
					'@dektrium/user/views' => '@app/themes/adminlte/views'
				],
				'baseUrl' => '@app/themes/adminlte',
			],
		],
	],
	'modules' => [
		'gridview' => [
			'class' => '\kartik\grid\Module'
		],
		'admin' => [
			'class' => 'mdm\admin\Module',
			'layout' => '@app/themes/adminlte/views/layouts/main',
		],
	],
	'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/login',
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
