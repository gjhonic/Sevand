<?php

namespace app\modules\core\modules\root;

use app\modules\core\Module;

/**
 * core module definition class
 */
class RootModule extends Module
{

    public $controllerNamespace = 'app\modules\core\modules\root\controllers';

    public function init()
    {
        parent::init();
    }
}
