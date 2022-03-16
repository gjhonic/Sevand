<?php

namespace app\modules\core\modules\admin\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/media/core/admin';
    public $css = [
        'css/dashboard.css',
        'css/bootstrap/bootstrap.min.css',
    ];
    public $js = [
        //'js/dashboard.js',
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
