<?php

use app\modules\core\models\base\User;
use app\modules\core\Module;
use yii\helpers\Url;

if (in_array(Yii::$app->user->identity->role, [User::ROLE_STUDENT, User::ROLE_HEADMAN])) {
    return [
        [
            'label' => Module::t('app', 'Home page'),
            'url' => Url::to('/personal/index'),
            'ico' => 'fa-home',
            'controller' => 'page',
            'action' => 'index'
        ],
        [
            'label' => Module::t('app', 'My group'),
            'url' => Url::to('/personal/group'),
            'ico' => 'fa-lock',
            'controller' => 'page',
            'action' => 'group'
        ],
        [
            'label' => Module::t('app', 'Settings'),
            'url' => Url::to('/personal/settings'),
            'ico' => 'fa-wrench',
            'controller' => 'page',
            'action' => 'settings'
        ]
    ];
} elseif(Yii::$app->user->identity->role === User::ROLE_CURATOR) {
    return [
        [
            'label' => Module::t('app', 'Home page'),
            'url' => Url::to('/personal/index'),
            'ico' => 'fa-home',
            'controller' => 'page',
            'action' => 'index'
        ],
        [
            'label' => Module::t('app', 'My group'),
            'url' => Url::to('/personal/group'),
            'ico' => 'fa-lock',
            'controller' => 'page',
            'action' => 'group'
        ],
        [
            'label' => Module::t('app', 'Settings'),
            'url' => Url::to('/personal/settings'),
            'ico' => 'fa-wrench',
            'controller' => 'page',
            'action' => 'settings'
        ]
    ];
}

