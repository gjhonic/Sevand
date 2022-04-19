<?php

use app\modules\core\Module;
use yii\helpers\Html;

/* @var $view_form string */
/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\Direction */

$this->title = Module::t('app', 'Create Student');
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Bases'), 'url' => ['/admin/bases']];
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_student', [
        'model' => $model,
    ]) ?>

</div>
