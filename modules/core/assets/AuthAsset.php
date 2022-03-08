<?php

namespace app\modules\core\assets;

use yii\web\AssetBundle;

class AuthAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/media/core/auth';

    public $css = [
        'vendor/bootstrap/css/bootstrap.min.css',
        'css/util.css',
        'css/main.css',
    ];

    public $js = [

    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
