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


<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?=Module::t('app', 'Directions')?></h5>
                <?= Html::a(
                    Module::t('app', 'Watch direction'),
                    Url::to('/admin/direction/index'),
                    ['class' => 'btn btn-outline-primary btn-block']
                ) ?>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?=Module::t('app', 'Courses')?></h5>
                <?= Html::a(
                    Module::t('app', 'Watch courses'),
                    Url::to('/admin/course/index'),
                    ['class' => 'btn btn-outline-primary btn-block']
                ) ?>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?=Module::t('app', 'Disciplines')?></h5>
                <?= Html::a(
                    Module::t('app', 'Watch disciplines'),
                    Url::to('/admin/discipline/index'),
                    ['class' => 'btn btn-outline-primary btn-block']
                ) ?>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?=Module::t('app', '...')?></h5>
                <?= Html::a(
                    Module::t('app', '...'),
                    Url::to('/admin/dictionaries'),
                    ['class' => 'btn btn-outline-primary btn-block']
                ) ?>
            </div>
        </div>
    </div>
</div>


