<?php

use app\modules\core\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\Direction */

$this->title = Yii::t('app', 'Update Direction: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Directions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->short_title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('app', 'Update');
?>
<div class="direction-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
