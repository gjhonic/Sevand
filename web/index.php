<?php

if (file_exists(__DIR__ . '/offline.php')) {
    include __DIR__ . '/offline.php';
    die(0);
}

require(__DIR__ . '/.env');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
