<?php

namespace app\modules\core\modules\root\assets;

use yii\web\AssetBundle;

class RootAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/media/core/root';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
