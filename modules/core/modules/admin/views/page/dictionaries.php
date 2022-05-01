<?php

use app\modules\core\Module;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $userCount int */
/* @var $groupCount int */
/* @var $directionCount int */
/* @var $studentCount int */
/* @var $disciplineCount int */

$this->title = Module::t('app', 'Dictionaries');
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= Module::t('app', 'Dictionaries') ?>
    <a href="<?= Url::to('/admin/department/view') ?>"><?= Yii::$app->user->identity->department->short_title ?></a>
</h1>

<table>
    <tr>
        <td>
            <div class="box-direct">
                <?=Module::t('app', 'Direction')?>:
                <?= Html::a(
                    Module::t('app', 'Watch direction'),
                    Url::to('/admin/direction/index'),
                    ['class' => 'btn btn-outline-primary btn-block']
                ) ?>
            </div>
        </td>
        <td>
            <?=Module::t('app', 'Courses')?>:
            <?= Html::a(
                Module::t('app', 'Watch courses'),
                Url::to('/admin/course/index'),
                ['class' => 'btn btn-outline-primary btn-block']
            ) ?>
        </td>
    </tr>
    <tr>
        <td>
            <?=Module::t('app', 'Disciplines')?>:
            <?= Html::a(
                Module::t('app', 'Watch disciplines'),
                Url::to('/admin/discipline/index'),
                ['class' => 'btn btn-outline-primary btn-block']
            ) ?>
        </td>
        <td>
            <?=Module::t('app', 'Direction')?>:
            <?= Html::a(
                Module::t('app', 'Watch direction'),
                Url::to('/admin/direction/index'),
                ['class' => 'btn btn-outline-primary btn-block']
            ) ?>
        </td>
    </tr>
</table>


