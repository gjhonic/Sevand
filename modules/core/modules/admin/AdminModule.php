<?php

namespace app\modules\core\modules\admin;

use app\modules\core\Module;
use Yii;

/**
 * core module definition class
 */
class AdminModule extends Module
{

    public $controllerNamespace = 'app\modules\core\modules\admin\controllers';

    public function init()
    {
        Yii::$app->params['bsVersion'] = '4.x';
        parent::init();
    }
}
