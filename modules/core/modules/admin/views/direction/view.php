<?php

use app\modules\core\Module;
use app\modules\core\modules\admin\components\ActivityComponent;
use app\modules\core\modules\admin\components\IcoComponent;
use app\modules\core\modules\admin\models\Direction;
use app\modules\core\modules\admin\models\User;
use app\modules\core\modules\admin\models\Group;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\Direction */
/* @var $groupProvider use app\modules\core\modules\admin\models\Group */


$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Dictionaries'), 'url' => ['/admin/dictionaries']];
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Directions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="direction-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (Yii::$app->user->identity->role !== User::ROLE_MODERATOR) { ?>
            <?= Html::a(IcoComponent::edit() . ' ' .Module::t('app', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(IcoComponent::delete() . ' ' .Module::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Module::t('note', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
        <?php
        if ($model->activity_id === Direction::ACTIVITY_ENABLE_ID) {
            echo Html::a(IcoComponent::disable() . ' ' . Module::t('app', 'To archive'), ['disable', 'id' => $model->id], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => Module::t('note', 'Are you sure you want to archive the discipline?'),
                ],
            ]);
        } elseif ($model->activity_id === Direction::ACTIVITY_DISABLE_ID) {
            echo Html::a(IcoComponent::enable() . ' ' .Module::t('app', 'Activate'), ['enable', 'id' => $model->id], [
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
                'format' => 'raw',
                'value' => function ($model) {
                    return ActivityComponent::getLabel($model->activity_id);
                }
            ],
            [
                'attribute' => 'department_id',
                'format' => 'raw',
                'value' => function ($model) {
                    $department = $model->department;
                    $departmentHtml = "<span style='color:red'>" . Module::t('app', 'Not set') . "</span>";
                    if($department) {
                        $departmentHtml = Html::a($model->department->short_title,
                            Url::to(['/admin/department/view']),
                            ['class' => 'btn btn-outline-primary']);
                    }
                    return $departmentHtml;
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

    <h3>
        <?=Module::t('app', 'Groups')?>:
    </h3>

    <?= GridView::widget([
        'dataProvider' => $groupProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            [
                'attribute' => 'course_id',
                'filter' => Direction::getDirectionMap(),
                'format' => 'raw',
                'value' => function ($model) {
                    $course = $model->course;
                    if ($course) {
                        return Html::a(
                            $course->title,
                            Url::to(['/admin/course/view', 'id' => $model->course_id]),
                            ['class' => 'btn btn-secondary btn-block']
                        );
                    }
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->created_at, "php:d.m.Y H:i:s");
                }
            ],
            [
                'attribute' => 'activity_id',
                'filter' => Group::getAtivities(),
                'value' => function ($model) {
                    return $model->activity;
                }
            ],
            [
                'label' => Module::t('app', 'Action column'),
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a(
                        IcoComponent::view() . ' ' . Module::t('app', 'Show'),
                        Url::to(['view', 'id' => $model->id]),
                        ['class' => 'btn btn-success btn-block']
                    );
                }
            ],
        ],
    ]); ?>
</div>
