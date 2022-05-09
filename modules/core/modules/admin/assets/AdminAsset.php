<?php

namespace app\modules\core\modules\admin\assets;

use yii\web\AssetBundle;

/**
 * Ассет для модуля core/admin
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/media/core/admin';
    public $css = [
        'css/dashboard.css',

        //доп иконки
        'css/font/css/font-awesome.css',
    ];
    public $js = [
        "js\bootstrap\bootstrap.bundle.js",
        "js\dashboard.js"
    ];
    public $depends = [
        'yii\bootstrap4\BootstrapAsset',
    ];
}
