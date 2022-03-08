<?php

use app\modules\core\Module;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div>
    <?=Html::a(
        Module::t('app', 'Universities'),
        Url::to(['/root/university/index']),
        ['class' => 'btn btn-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Departments'),
        Url::to(['/root/department/index']),
        ['class' => 'btn btn-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Users'),
        Url::to(['/root/user/index']),
        ['class' => 'btn btn-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Groups'),
        Url::to(['/root/group/index']),
        ['class' => 'btn btn-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Students'),
        Url::to(['/root/student/index']),
        ['class' => 'btn btn-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Logs'),
        Url::to(['/root/log/index']),
        ['class' => 'btn btn-primary btn-lg']
    );?>
</div>
