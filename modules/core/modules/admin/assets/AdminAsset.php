<?php

namespace app\modules\core\modules\admin\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/media/core/admin';
    public $css = [
        'css/bootstrap/bootstrap.min.css',
        'css/dashboard.css',

        //доп иконки
        'css/font/font-awesome.css',
    ];
    public $js = [
        "js\bootstrap\bootstrap.bundle.js",
        "js\dashboard.js"
    ];
    public $depends = [
    ];
}
