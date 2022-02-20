<?php

//Роутинг на модуль "Konus"
return [
    'konus' => 'konus/page/index',
    'konus/<controller:\w+>' => 'konus/<controller>/index',
    'konus/<controller:\w+>/<action:\w+>' => 'konus/<controller>/<action>',
];