<?php

$_ENV = array_merge($_ENV, require(__DIR__ . '/.env'));
$route = array_merge(require(__DIR__ . '/route.php'));

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'sevand',
    'name' => "СЕВАНД",
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@modules' => '@app/modules',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'birpLMYQGEglzDvRGJF5w5SHhQMMD9mF',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\core\models\auth\UserIdentity',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'file' => [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['en', 'ru'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => $route,
            'ignoreLanguageUrlPatterns' => [
                //'#^api/#' =>'#^api/#',
            ],
            'enableDefaultLanguageUrlCode' => true,
            'enableLanguagePersistence' => true,
        ],
        'i18n' => [
            'translations' => [
            ],
        ],
    ],
    'modules' => [
        'auth' => [
            'class' => 'app\modules\auth\Module',
        ],
        'core' => [
            'class' => 'app\modules\core\Module',
            'modules' => [
                'admin' => [
                    'class' => 'app\modules\core\modules\admin\AdminModule',
                ],
                'personal' => [
                    'class' => 'app\modules\core\modules\personal\ApiModule',
                ],
                'root' => [
                    'class' => 'app\modules\core\modules\root\RootModule',
                ],
                'api' => [
                    'class' => 'app\modules\core\modules\api\ApiModule',
                ],
                'guest' => [
                    'class' => 'app\modules\core\modules\guest\GuestModule',
                ],
            ],
        ],
        'konus' => [
            'class' => 'app\modules\konus\Module',
        ],
        'msk' => [
            'class' => 'app\modules\msk\Module',
        ],
        'attendance' => [
            'class' => 'app\modules\attendance\Module',
        ],
        'dynagrid'=> [
            'class'=>'\kartik\dynagrid\Module',
            // other module settings
        ],
        'gridview'=> [
            'class'=>'\kartik\grid\Module',
            // other module settings
        ],
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
