<?php

use app\modules\core\Module;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $countUser int */
/* @var $countStudent int */
/* @var $countGroup int */
/* @var $countDirection int */
/* @var $countDiscipline int */

$this->title = Module::t('app', 'Bases');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="block-bases">
    <h1><?= Module::t('app', 'Base') ?>
        <a href="<?= Url::to('/admin/department/view') ?>"><?= Yii::$app->user->identity->department->short_title ?></a>
    </h1>

    <table class="table table-bordered table-linght">
        <thead class="thead-light">
        <tr>
            <td colspan="2" align="center">
                <strong>
                    <?=Module::t('app', 'User base')?>
                </strong>
            </td>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="2">
                    <img src="" class="td_image" alt="" width="60%">
                </td>
                <td width="60%">
                    <?=Module::t('app', 'Count user')?>:
                    <i>
                        <?=$countUser?>
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

    <table class="table table-bordered table-linght">
        <thead class="thead-light">
            <tr>
                <td colspan="2" align="center">
                    <strong>
                        <?=Module::t('app', 'Group base')?>
                    </strong>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="3">
                    <img src="" class="td_image" alt="" width="60%">
                </td>

                <td width="60%">
                    <?=Module::t('app', 'Count groups')?>:
                    <i>
                        <?=$countGroup?>
                    </i>
                    <br>
                    <?=Module::t('app', 'Count direction')?>:
                    <i>
                        <?=$countDirection?>
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
                    <?= Html::a(
                        Module::t('app', 'Watch direction'),
                        Url::to('/admin/direction/index'),
                        ['class' => 'btn btn-outline-primary btn-block']
                    ) ?>
                </td>
            </tr>
        </tbody>
    </table>
    <br>

    <!-- Панель базы студентов -->
    <table class="table table-bordered table-linght">
        <thead class="thead-light">
            <tr>
                <td colspan="2" align="center">
                    <strong>
                        <?=Module::t('app', 'Student base')?>
                    </strong>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="2">
                    <img src="" class="td_image" alt="" width="60%">
                </td>
                <td width="60%">
                    <?=Module::t('app', 'Count students')?>:
                    <i>
                        <?=$countStudent?>
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

    <table class="table table-bordered table-linght">
        <thead class="thead-light">
            <tr>
                <td colspan="2" align="center">
                    <strong>
                        <?=Module::t('app', 'Discipline base')?>
                    </strong>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="3">
                    <img src="" class="td_image" alt="" width="60%">
                </td>
                <td width="60%">
                    <?=Module::t('app', 'Count discipline')?>:
                    <i>
                        <?=$countDiscipline?>
                    </i>
                </td>
            </tr>
            <tr>
                <td>
                    <?= Html::a(
                        Module::t('app', 'Go'),
                        Url::to('/admin/discipline/index'),
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
</style>
