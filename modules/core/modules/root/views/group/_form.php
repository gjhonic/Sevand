<?php

use app\modules\core\models\base\Course;
use app\modules\core\models\base\Department;
use app\modules\core\models\base\Direction;
use app\modules\core\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\Group */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'course_id')->dropDownList(Course::getCourseMap()) ?>

    <?= $form->field($model, 'department_id')->dropDownList(Department::getDepartmentGroup()) ?>

    <?= $form->field($model, 'direction_id')->dropDownList(Direction::getDirectionMap()) ?>

    <div class="form-group">
        <?= Html::submitButton(Module::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
