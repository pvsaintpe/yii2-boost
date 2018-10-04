<?php

return [
    'class' => 'yii\web\Application',
    'id' => 'test-app',
    'language' => 'ru',
    'basePath' => __DIR__,
    'vendorPath' => dirname(dirname(YII2_PATH)),
    'controllerMap' => ['test' => 'pvsaintpe\boost\tests\TestController'],
    'components' => [
        'request' => [
            'class' => 'pvsaintpe\boost\tests\Request',
            'enableCookieValidation' => false
        ]
    ]
];
