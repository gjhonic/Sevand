<?php

//Роутинг на модуль "Core"
return [

    '' => 'core/page/index',
    'index' => 'core/page/index',
    'admin' => 'core/admin/index',
    //'admin/<action:\w+>' => 'core/admin/<action>',
    '<controller:\w+>/<action:\w+>' => 'core/<controller>/<action>',
];