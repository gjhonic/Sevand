<?php

use app\modules\core\models\base\User;
use app\modules\core\Module;
use yii\helpers\Url;

if (Yii::$app->user->identity->role === User::ROLE_ROOT) {
    return [
        [
            'label' => Module::t('app', 'Bases'),
            'url' => Url::to('/admin/bases'),
            'ico' => 'fa-sort',
            'controller' => 'page',
            'action' => 'bases'
        ],
        [
            'label' => Module::t('app', 'Settings'),
            'url' => Url::to('/settings/index'),
            'ico' => 'fa-wrench',
            'controller' => 'settings',
            'action' => 'index'
        ],
        [
            'label' => Module::t('app', 'Logs'),
            'url' => Url::to('/admin/log'),
            'ico' => 'fa-book',
            'controller' => 'log',
            'action' => 'index'
        ]
    ];
} else if (Yii::$app->user->identity->role === User::ROLE_ADMIN) {
    return [
        [
            'label' => Module::t('app', 'Bases'),
            'url' => Url::to('/admin/bases'),
            'ico' => 'fa-database',
            'controller' => 'page',
            'action' => 'bases'
        ],
        [
            'label' => Module::t('app', 'Settings'),
            'url' => Url::to('/settings/index'),
            'ico' => 'fa-wrench',
            'controller' => 'settings',
            'action' => 'index'
        ],
        [
            'label' => Module::t('app', 'Logs'),
            'url' => Url::to('/admin/log'),
            'ico' => 'fa-book',
            'controller' => 'log',
            'action' => 'index'
        ]
    ];
} elseif(Yii::$app->user->identity->role === User::ROLE_MODERATOR) {
    return [
        [
            'label' => Module::t('app', 'Bases'),
            'url' => Url::to('/admin/bases'),
            'ico' => 'fa-database',
            'controller' => 'page',
            'action' => 'bases'
        ],
        [
            'label' => Module::t('app', 'Settings'),
            'url' => Url::to('/settings/index'),
            'ico' => 'fa-wrench',
            'controller' => 'settings',
            'action' => 'index'
        ]
    ];
}

