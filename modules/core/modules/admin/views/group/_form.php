<?php

use app\modules\core\models\base\Course;
use app\modules\core\models\base\Direction;
use app\modules\core\modules\admin\models\User;
use app\modules\core\modules\admin\components\IcoComponent;
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
    
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'direction_id')->dropDownList(Direction::getDirectionMap()) ?>
        </div>
        <?php if (Yii::$app->user->identity->role !== User::ROLE_MODERATOR) { ?>
            <div class="col-md-4">
                <label for="" style="visibility: hidden;">
                    *
                </label>
                <br>
                <?= Html::a(IcoComponent::add() . ' ' . Module::t('app', 'Create Direction'), ['direction/create'], ['class' => 'btn btn-success btn-block']) ?>
            </div>
        <?php } ?>
    </div>
    

    <div class="form-group">
        <?= Html::submitButton(Module::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
