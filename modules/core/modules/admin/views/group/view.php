<?php

use app\modules\core\Module;
use app\modules\core\modules\admin\components\IcoComponent;
use app\modules\core\modules\admin\models\Group;
use app\modules\core\modules\admin\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\Group */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="group-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (Yii::$app->user->identity->role !== User::ROLE_MODERATOR) { ?>
            <?= Html::a(IcoComponent::edit() . ' ' . Module::t('app', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(IcoComponent::delete() . ' ' . Module::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Module::t('note', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
        <?php
        if ($model->activity_id === Group::ACTIVITY_ENABLE_ID) {
            echo Html::a(IcoComponent::disable() . ' ' . Module::t('app', 'To archive'), ['disable', 'id' => $model->id], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => Module::t('note', 'Are you sure you want to archive the discipline?'),
                ],
            ]);
        } elseif ($model->activity_id === Group::ACTIVITY_DISABLE_ID) {
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
            [
                'attribute' => 'course_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->course->title,
                        Url::to(['/course/view', 'id' => $model->course_id]),
                        ['class' => 'btn btn-outline-secondary']);
                }
            ],
            [
                'attribute' => 'direction_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->direction->short_title,
                        Url::to(['/direction/view', 'id' => $model->direction_id]),
                        ['class' => 'btn btn-outline-secondary']);
                }
            ],
            [
                'attribute' => 'curator_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->curator->username,
                        Url::to(['/user/view', 'id' => $model->curator_id]),
                        ['class' => 'btn btn-outline-secondary']);
                }
            ],
            [
                'attribute' => 'headman_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->headman->username,
                        Url::to(['/user/view', 'id' => $model->headman_id]),
                        ['class' => 'btn btn-outline-secondary']);
                }
            ],
            [
                'attribute' => 'department_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->department->short_title,
                        Url::to(['/department/view', 'id' => $model->department_id]),
                        ['class' => 'btn btn-outline-secondary']);
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return date('j F, Y H:i:s', $model->created_at);
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    return date('j F, Y H:i:s', $model->updated_at);
                }
            ]
        ],
    ]) ?>

</div>
