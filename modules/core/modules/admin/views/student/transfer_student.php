<?php

use app\modules\core\Module;
use app\modules\core\modules\admin\models\Group;
use app\modules\core\modules\admin\models\User;
use app\modules\core\modules\admin\components\IcoComponent;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\Student */

$this->title = Module::t('app', 'Transfer Student');
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Students'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fullname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="student-form">

        <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col">
                    <label for="text-from-group" style="visibility: hidden">1</label>
                    <?php
                    $group = $model->group;
                        if ($group) { ?>
                            <input type="text" class="form-control" disabled value="<?=Module::t('app', 'Transfer from') . ' ' . $group->title . ' '
                            . Module::t('app', 'in')?>" >
                        <?php } else {
                            echo Module::t('app', 'Transfer from');
                        }
                    ?>
                </div>

                <div class="col">
                    <?= $form->field($model, 'group_id')->dropDownList(Group::getGroupsMap()) ?>
                </div>
            </div>

            <dev class="row">
                <div class="col"></div>
                <div class="col">
                <?php
                    if (Yii::$app->user->identity->role !== User::ROLE_MODERATOR) { ?>
                        <?= Html::a(
                            IcoComponent::add() . ' ' . Module::t('app', 'Create Group'),
                            ['group/create'],
                            ['class' => 'btn btn-success']
                        ) ?>
                <?php } ?>
                </div>
            </dev>

            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>
                </div>
            </div>

        <div class="form-group">
            <?= Html::submitButton(Module::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
