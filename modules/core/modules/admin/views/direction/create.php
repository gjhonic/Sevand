<?php

use app\modules\core\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\Direction */

$this->title = Module::t('app', 'Create Direction');
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Dictionaries'), 'url' => ['/admin/dictionaries']];
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Directions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="direction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
