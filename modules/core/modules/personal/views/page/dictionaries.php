<?php

use app\modules\core\Module;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $directionCount int */
/* @var $courseCount int */
/* @var $disciplineCount int */

$this->title = Module::t('app', 'Dictionaries');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="block-bases">
    <h1><?= Module::t('app', 'Dictionaries') ?>
        <a href="<?= Url::to('/admin/department/view') ?>"><?= Yii::$app->user->identity->department->short_title ?></a>
    </h1>
    <table class="table table-bordered table-linght">
        <tbody>
        <tr>
            <td class="block-title" rowspan="2" >
                <h2 class="title-base"><?=Module::t('app', 'Directions')?></h2>
            </td>
            <td width="60%">
                <?=Module::t('app', 'Count direction')?>:
                <i>
                    <?=$directionCount?>
                </i>
            </td>
        </tr>
        <tr>
            <td>
                <?= Html::a(
                    Module::t('app', 'Watch directions'),
                    Url::to('/admin/direction/index'),
                    ['class' => 'btn btn-outline-primary btn-block']
                ) ?>
            </td>
        </tr>
        </tbody>
    </table>
    <br>

    <table class="table table-bordered table-linght">
        <tbody>
        <tr>
            <td class="block-title" rowspan="3">
                <h2 class="title-base"><?=Module::t('app', 'Courses')?></h2>
            </td>

            <td width="60%">
                <?=Module::t('app', 'Count courses')?>:
                <i>
                    <?=$courseCount?>
                </i>
            </td>
        </tr>
        <tr>
            <td>
                <?= Html::a(
                    Module::t('app', 'Watch courses'),
                    Url::to('/admin/course/index'),
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
                <h2 class="title-base"><?=Module::t('app', 'Disciplines')?></h2>
            </td>
            <td width="60%">
                <?=Module::t('app', 'Count discipline')?>:
                <i>
                    <?=$disciplineCount?>
                </i>
            </td>
        </tr>
        <tr>
            <td>
                <?= Html::a(
                    Module::t('app', 'Watch disciplines'),
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
    .block-title{
        position: relative;
    }
    .title-base{
        position: absolute;
        top: 30%;
        left: 10%;
    }
</style>


