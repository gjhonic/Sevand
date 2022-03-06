<?php

use app\modules\core\Module;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div>
    <?=Html::a(
        Module::t('app', 'Directions'),
        Url::to(['/root/direction/index']),
        ['class' => 'btn btn-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Courses'),
        Url::to(['/root/course/index']),
        ['class' => 'btn btn-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Disciplines'),
        Url::to(['/root/discipline/index']),
        ['class' => 'btn btn-primary btn-lg']
    );?>
</div>
