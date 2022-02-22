<?php

use app\modules\core\Module;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = Module::t('app', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="limiter box-auth">
    <div class="container-login100">
        <div class="wrap-login100 p-t-40 p-b-90">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
                ],
            ]); ?>

            <span class="login100-form-title p-b-51">
                <?=Module::t('app', 'Personal account')?>
            </span>
            <?= Alert::widget() ?>

            <div class="wrap-input100 validate-input m-b-16" data-validate = "Введите логин">
                <input class="input100" type="text" name="username"
                       placeholder="<?=Module::t('app', 'Username')?>"
                       required>
                <span class="focus-input100"></span>
            </div>


            <div class="wrap-input100 validate-input m-b-16" data-validate = "Введите пароль">
                <input class="input100" type="password" name="password"
                       placeholder="<?=Module::t('app', 'Password')?>"
                       required>
                <span class="focus-input100"></span>
            </div>

            <div class="flex-sb-m w-full p-t-3 p-b-24">
                <div class="contact100-form-checkbox">
                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="rememberMe">
                    <label class="label-checkbox100" for="ckb1">
                        <?=Module::t('app', 'Remember me')?>
                    </label>
                </div>
            </div>

            <div class="container-login100-form-btn m-t-17">
                <?= Html::submitButton(Module::t('app', 'Sign in'), ['class' => 'login100-form-btn', 'name' => 'login-button']) ?>
            </div>
            <p>
                <a href="" class="txt1">
                    <p align='center'>
                        <?=Module::t('app', 'Log in as a guest')?>
                    </p>
                </a>
            </p>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
