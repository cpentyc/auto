<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'languages'],
    'controllerNamespace' => 'frontend\controllers',
    'sourceLanguage' => 'ru',
    'modules' => [
        'languages' => [
            'class' => 'common\modules\languages\Module',
            //Языки используемые в приложении
            'languages' => [
                'English' => 'en',
                'Русский' => 'ru',
                'Казахский' => 'kz',
            ],
            'default_language' => 'ru', //основной язык (по-умолчанию)
            'show_default' => false, //true - показывать в URL основной язык, false - нет
        ],
    ],
    'components' => [
        'assetManager' => [
            'bundles' => [
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                        'key' => 'AIzaSyAblHdTeXnZLcxqqb50mYDGHiqxSk4F4Ck',
                        'language' => 'id',
                        'version' => '3.1.18'
                    ]
                ]
            ]
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'forceTranslation' => true,
                    'basePath' => '@common/messages',
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '', // убрать frontend/web
            'class' => 'common\components\Request'
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,

            'class' => 'common\components\UrlManager',
            'rules' => [
                'languages' => 'languages/default/index', //для модуля мультиязычности
                //далее создаем обычные правила
                '/' => 'site/index',
                'news/<slug>' => 'news/view',
                'stocks/<slug>' => 'news/stock-view',
                'page/<slug>' => 'news/page-view',
                'news' => 'news/index',
                'contacts/<id>' => 'site/contacts',
                'catalog' => 'category/index',
                'catalog/<slug>/<subSlug>' => 'category/view',
                'catalog/<slug>' => 'category/view',
                'product_<slug>' => 'category/product',
                'd-max-landing' => 'site/landing',

                'stocks' => 'news/stock-index',
                '<action:(contact|login|logout|language|about|signup)>' => 'site/<action>',
            ],
        ],
    ],
    'params' => $params,
];
