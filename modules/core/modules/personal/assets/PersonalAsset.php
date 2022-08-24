<?php

namespace app\modules\core\modules\personal\assets;

use yii\web\AssetBundle;

/**
 * Ассет для модуля core/personal
 */
class PersonalAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/media/core/personal';
    public $css = [
       'css/bootstrap.min.css',
       'css/style.css',
    ];
    public $js = [
        'jquery/jquery-3.6.0.min.js'
    ];
    public $depends = [

    ];
}
