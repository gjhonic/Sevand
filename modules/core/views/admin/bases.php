<?php

use app\modules\core\Module;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div>
    <?=Html::a(
        Module::t('app', 'Universities'),
        Url::to(['/university/index']),
        ['class' => 'btn btn-outline-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Departments'),
        Url::to(['/department/index']),
        ['class' => 'btn btn-outline-primary btn-lg']
    );?>

    <?=Html::a(
        Module::t('app', 'Directions'),
        Url::to(['/direction/index']),
        ['class' => 'btn btn-outline-primary btn-lg']
    );?>
</div>
