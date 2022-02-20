<?php

return [

    //Роутинг на модуль "Core"
    '' => 'core/page/index',
    'index' => 'core/page/index',
    //'admin/<action:\w+>' => 'core/admin/<action>',
    '<controller:\w+>/<action:\w+>' => 'core/<controller>/<action>',

    //Роутинг на модуль "KONUS"
    'konus' => 'konus/page/index',
    'konus/<controller:\w+>' => 'konus/<controller>/index',
    'konus/<controller:\w+>/<action:\w+>' => 'konus/<controller>/<action>',
];