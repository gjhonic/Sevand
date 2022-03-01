<?php

use app\modules\core\models\base\User;
use app\modules\core\Module;
use yii\helpers\Url;


if (Yii::$app->user->isGuest) {
    return [
        [
            'label' => Module::t('app', 'Sign in'),
            'url' => Url::to('/signin'),
            'ico' => 'uil-sign-in-alt',
        ]
    ];
} else if(Yii::$app->user->identity->groupRole == User::GROUP_ROLE_ADMIN) {
    return [
        [
            'label' => Module::t('app', 'Admin panel'),
            'url' => Url::to('/admin'),
            'ico' => '',
        ],
        [
            'label' => Module::t('app', 'Settings'),
            'url' => ['/'],
            'ico' => '',
        ]
    ];
} else {
    return [
        [
            'label' => Module::t('app', 'Settings'),
            'url' => ['/'],
            'ico' => '',
        ]
    ];
}





/*if (Yii::$app->user->isGuest) {
    return [
        'main' => [
            [
                'label' => Yii::t('app', 'Raffles'),
                'href' => Url::to('/raffle/index'),
                'controller' => 'raffle',
                'action' => 'index'
            ],
            [
                'label' => Yii::t('app', 'Tags'),
                'href' => Url::to('/tag/index'),
                'controller' => 'tag',
                'action' => 'index'
            ],
            [
                'label' => Yii::t('app', 'Sign in'),
                'href' => Url::to('/signin'),
                'controller' => 'auth',
                'action' => 'signin'
            ],
            [
                'label' => Yii::t('app', 'Sign up'),
                'href' => Url::to('/signup'),
                'controller' => 'auth',
                'action' => 'signup'
            ],
        ],
    ];
} else {
    if (Yii::$app->user->identity->role_id == User::ROLE_USER_ID) {
        return [
            'main' => [
                [
                    'label' => Yii::t('app', 'Profile'),
                    'href' => Url::to('/profile'),
                    'controller' => 'site',
                    'action' => 'profile'
                ],
                [
                    'label' => Yii::t('app', 'Raffles'),
                    'href' => Url::to('/raffle/index'),
                    'controller' => 'raffle',
                    'action' => 'index'
                ],
                [
                    'label' => Yii::t('app', 'Tags'),
                    'href' => Url::to('/tag/index'),
                    'controller' => 'tag',
                    'action' => 'index'
                ],
                [
                    'label' => Yii::t('app', 'Create a raffle'),
                    'href' => Url::to('/raffle/create'),
                    'controller' => 'raffle',
                    'action' => 'create'
                ],
                [
                    'label' => Yii::t('app', 'Settings'),
                    'href' => Url::to('/settings/index'),
                    'controller' => 'settings',
                    'action' => 'index'
                ],
                [
                    'label' => Yii::t('app', 'Logout'),
                    'href' => Url::to('/signout'),
                    'controller' => 'auth',
                    'action' => 'signout'
                ],
            ],
        ];
    } else {
        return [
            'main' => [
                [
                    'label' => Yii::t('app', 'Profile'),
                    'href' => Url::to('/profile'),
                    'controller' => 'site',
                    'action' => 'profile'
                ],
                [
                    'label' => Yii::t('app', 'Admin panel'),
                    'href' => Url::to('/admin/'),
                    'controller' => 'admin',
                    'action' => 'asfaf'
                ],
                [
                    'label' => Yii::t('app', 'Raffles'),
                    'href' => Url::to('/raffle/index'),
                    'controller' => 'raffle',
                    'action' => 'index'
                ],
                [
                    'label' => Yii::t('app', 'Tags'),
                    'href' => Url::to('/tag/index'),
                    'controller' => 'tag',
                    'action' => 'index'
                ],
                [
                    'label' => Yii::t('app', 'Settings'),
                    'href' => Url::to('/settings/index'),
                    'controller' => 'settings',
                    'action' => 'index'
                ],
                [
                    'label' => Yii::t('app', 'Logout'),
                    'href' => Url::to('/signout'),
                    'controller' => 'auth',
                    'action' => 'signout'
                ],
            ],
        ];
    }
}*/

