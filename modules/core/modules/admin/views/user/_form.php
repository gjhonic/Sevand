<?php

use app\modules\core\models\base\Department;
use app\modules\core\models\base\User;
use app\modules\core\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="direction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?php
        if ($model->isNewRecord) { ?>
            <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>
    <?php } ?>

    <?= $form->field($model, 'role')->dropDownList(User::getRolesForAdmin()) ?>

    <div class="form-group">
        <?= Html::submitButton(Module::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
