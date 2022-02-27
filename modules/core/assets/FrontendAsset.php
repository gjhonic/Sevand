<?php

namespace app\modules\core\assets;

use yii\web\AssetBundle;

class FrontendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/media/core/frontend';
    public $css = [
        'plugins/filter/magnific-popup.css',
        'plugins/animated/headline.css',
        'css/bootstrap.min.css',
        'css/icons.css',
        'css/style.css',

        //доп иконки
        'font-awesome/css/font-awesome.css',
    ];
    public $js = [
        "js\jquery.min.js",
        "js\bootstrap.bundle.min.js",
        "plugins/ripple/jquery.ripples.js",
        "plugins/counter/jquery.counterup.min.js",
        "plugins/counter/waypoints.min.js",
        "plugins/filter/isotope.pkgd.min.js",
        "plugins/filter/masonry.pkgd.min.js",
        "plugins/filter/jquery.magnific-popup.min.js",
        "plugins/animated/headline.js",
        'js\app.js',
    ];
    public $depends = [

    ];
}
