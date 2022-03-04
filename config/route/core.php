<?php

//Роутинг на модуль "Core"
return [

    'signin' => '/core/auth/signin',
    'signout' => '/core/auth/signout',
    'me' => 'core/page/me',
    'ban' => 'core/page/ban',

    '' => 'core/page/index',
    'index' => 'core/page/index',
    'admin' => 'core/admin/page/index',
    'admin/index' => 'core/admin/page/index',
    'admin/bases' => 'core/admin/page/bases',

    'admin/<controller:\w+>/<action:\w+>' => 'core/admin/<controller>/<action>',

    //'admin/<action:\w+>' => 'core/admin/<action>',
    '<controller:\w+>/<action:\w+>' => 'core/<controller>/<action>',
];