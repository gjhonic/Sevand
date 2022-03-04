<?php

use app\modules\core\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\University */

$this->title = Module::t('app', 'Create University');
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Universities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="university-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
