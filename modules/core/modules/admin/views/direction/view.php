<?php

use app\modules\core\Module;
use app\modules\core\modules\admin\models\Direction;
use app\modules\core\modules\admin\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\Direction */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Bases'), 'url' => ['/admin/bases']];
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Directions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="direction-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (Yii::$app->user->identity->role !== User::ROLE_MODERATOR) { ?>
            <?= Html::a(Module::t('app', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Module::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Module::t('note', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
        <?php
        if ($model->activity_id === Direction::ACTIVITY_ENABLE_ID) {
            echo Html::a(Module::t('app', 'To archive'), ['disable', 'id' => $model->id], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => Module::t('note', 'Are you sure you want to archive the discipline?'),
                ],
            ]);
        } elseif ($model->activity_id === Direction::ACTIVITY_DISABLE_ID) {
            echo Html::a(Module::t('app', 'Activate'), ['enable', 'id' => $model->id], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => Module::t('note', 'Are you sure you want to activate the discipline?'),
                ],
            ]);
        }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'short_title',
            [
                'attribute' => 'activity_id',
                'value' => function ($model) {
                    return $model->activity;
                }
            ],
            [
                'attribute' => 'department_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->department->short_title,
                        Url::to(['/admin/department/view']),
                        ['class' => 'btn btn-primary']);
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->created_at, "php:d.m.Y H:i:s");
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->updated_at, "php:d.m.Y H:i:s");
                }
            ]
        ],
    ]) ?>

    <h3>
        <?=Module::t('app', 'Description')?>
    </h3>
    <div class="jumbotron">
        <?=$model->description?>
    </div>
</div>
