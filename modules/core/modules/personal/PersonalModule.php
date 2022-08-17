<?php

namespace app\modules\core\modules\personal;

use app\modules\core\Module;
use Yii;

/**
 * core module definition class
 */
class PersonalModule extends Module
{

    public $controllerNamespace = 'app\modules\core\modules\personal\controllers';

    public function init()
    {
        Yii::$app->params['bsVersion'] = '4.x';
        parent::init();
    }
}
