<?php
/**
 * AuthAsset
 * Ассет для модуля Аутентификации
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */
namespace app\modules\auth\assets;

use yii\web\AssetBundle;

class AuthAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/media/auth';

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
