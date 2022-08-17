<?php

use app\modules\core\Module;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $userCount int */
/* @var $groupCount int */
/* @var $directionCount int */
/* @var $studentCount int */
/* @var $disciplineCount int */

$this->title = Module::t('app', 'Bases');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="block-bases">
    <h1><?= Module::t('app', 'Base') ?>
        <a href="<?= Url::to('/admin/department/view') ?>"><?= Yii::$app->user->identity->department->short_title ?></a>
    </h1>

    <!-- Панель базы пользователей -->
    <table class="table table-bordered table-linght">
        <tbody>
            <tr>
                <td class="block-title" rowspan="2" >
                    <h2 class="title-base"><?=Module::t('app', 'Users')?></h2>
                </td>
                <td width="60%">
                    <?=Module::t('app', 'Count user')?>:
                    <i>
                        <?=$userCount?>
                    </i>
                </td>
            </tr>
            <tr>
                <td>
                    <?= Html::a(
                        Module::t('app', 'Go'),
                        Url::to('/admin/user/index'),
                        ['class' => 'btn btn-outline-primary btn-block']
                    ) ?>
                </td>
            </tr>
        </tbody>
    </table>
    <br>

    <!-- Панель базы групп -->
    <table class="table table-bordered table-linght">
        <tbody>
            <tr>
                <td class="block-title" rowspan="3">
                    <h2 class="title-base"><?=Module::t('app', 'Groups')?></h2>
                </td>

                <td width="60%">
                    <?=Module::t('app', 'Count groups')?>:
                    <i>
                        <?=$groupCount?>
                    </i>
                </td>
            </tr>
            <tr>
                <td>
                    <?= Html::a(
                        Module::t('app', 'Watch groups'),
                        Url::to('/admin/group/index'),
                        ['class' => 'btn btn-outline-primary btn-block']
                    ) ?>
                </td>
            </tr>
        </tbody>
    </table>
    <br>

    <!-- Панель базы студентов -->
    <table class="table table-bordered table-linght">
        <tbody>
            <tr>
                <td class="block-title" rowspan="2">
                    <h2 class="title-base"><?=Module::t('app', 'Students')?></h2>
                </td>
                <td width="60%">
                    <?=Module::t('app', 'Count students')?>:
                    <i>
                        <?=$studentCount?>
                    </i>
                </td>
            </tr>
            <tr>
                <td>
                    <?= Html::a(
                        Module::t('app', 'Go'),
                        Url::to('/admin/student/index'),
                        ['class' => 'btn btn-outline-primary btn-block']
                    ) ?>
                </td>
            </tr>
        </tbody>
    </table>
    <br>

    <!-- Панель базы историй переводов студентов -->
    <table class="table table-bordered table-linght">
        <tbody>
        <tr>
            <td class="block-title" rowspan="2">
                <h3 class="title-base"><?=Module::t('app', 'Students Transfer Log')?></h3>
            </td>
            <td width="60%">
                <?=Module::t('app', 'Count students')?>:
                <i>
                    <?=$studentCount?>
                </i>
            </td>
        </tr>
        <tr>
            <td>
                <?= Html::a(
                    Module::t('app', 'Go'),
                    Url::to('/admin/transfer/index'),
                    ['class' => 'btn btn-outline-primary btn-block']
                ) ?>
            </td>
        </tr>
        </tbody>
    </table>
    <br>

</div>

<style>
    table {
        height: 150px;
        background-color: #fafafa;
        font-size: 22px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    }

    table:hover {
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
    }

    .td_image {
        margin: 2% 20%;
    }
    .block-title{
        position: relative;
    }
    .title-base{
        position: absolute;
        top: 35%;
    }
</style>
