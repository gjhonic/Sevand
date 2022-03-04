<?php

use app\modules\core\Module;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div>
    <?=Html::a(
        Module::t('app', 'Universities'),
        Url::to(['/admin/university/index']),
        ['class' => 'btn btn-outline-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Departments'),
        Url::to(['/admin/department/index']),
        ['class' => 'btn btn-outline-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Directions'),
        Url::to(['/admin/direction/index']),
        ['class' => 'btn btn-outline-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Courses'),
        Url::to(['/admin/course/index']),
        ['class' => 'btn btn-outline-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Users'),
        Url::to(['/admin/user/index']),
        ['class' => 'btn btn-outline-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Disciplines'),
        Url::to(['/admin/discipline/index']),
        ['class' => 'btn btn-outline-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Groups'),
        Url::to(['/admin/group/index']),
        ['class' => 'btn btn-outline-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Students'),
        Url::to(['/admin/student/index']),
        ['class' => 'btn btn-outline-primary btn-lg']
    );?>
</div>
