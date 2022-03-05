<?php

namespace app\modules\core\modules\admin;

use app\modules\core\Module;

/**
 * core module definition class
 */
class AdminModule extends Module
{

    public $controllerNamespace = 'app\modules\core\modules\admin\controllers';

    public function init()
    {
        parent::init();
    }
}
