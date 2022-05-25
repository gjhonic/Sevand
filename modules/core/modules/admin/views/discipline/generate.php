<?php


use app\modules\core\Module;
use yii\helpers\Html;
use app\modules\core\modules\admin\models\Discipline;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\Discipline */
/* @var $form yii\widgets\ActiveForm */
/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\Discipline */

$this->title = Module::t('app', 'Create Discipline');
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Dictionaries'), 'url' => ['/admin/dictionaries']];
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Disciplines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discipline-generate">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="discipline-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'text_discipline')->textarea(['row' => 8]) ?>

        <div class="form-group">
            <?= Html::submitButton(Module::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
