<?php

use app\modules\core\Module;
use yii\helpers\Url;

return [
    [
        'label' => Module::t('app', 'Bases'),
        'url' => Url::to('/root/bases')
    ],
    [
        'label' => Module::t('app', 'Dictionaries'),
        'url' => Url::to('/root/dictionaries')
    ],
];


