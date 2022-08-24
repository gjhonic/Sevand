<?php

namespace app\modules\core\modules\api;

use app\modules\core\Module;

/**
 * core module definition class
 */
class ApiModule extends Module
{

    public $controllerNamespace = 'app\modules\core\modules\api\controllers';

    public function init()
    {
        parent::init();
    }
}
