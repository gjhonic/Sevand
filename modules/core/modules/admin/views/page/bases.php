<?php

use app\modules\core\Module;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div>
    <?=Html::a(
        Module::t('app', 'Directions'),
        Url::to(['/admin/direction/index']),
        ['class' => 'btn btn-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Users'),
        Url::to(['/admin/user/index']),
        ['class' => 'btn btn-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Disciplines'),
        Url::to(['/admin/discipline/index']),
        ['class' => 'btn btn-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Groups'),
        Url::to(['/admin/group/index']),
        ['class' => 'btn btn-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Students'),
        Url::to(['/admin/student/index']),
        ['class' => 'btn btn-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Logs'),
        Url::to(['/admin/log/index']),
        ['class' => 'btn btn-primary btn-lg']
    );?>
</div>
