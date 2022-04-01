<?php

use app\modules\core\Module;
use app\modules\core\modules\admin\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\User */

$this->title = Module::t('app', 'User') . ': ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Bases'), 'url' => ['/admin/bases']];
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
            if($model->activity_id === User::ACTIVITY_ENABLE_ID){
                echo Html::a(Module::t('app', 'Deactivate'), ['disable', 'id' => $model->id], [
                    'class' => 'btn btn-warning',
                    'data' => [
                        'confirm' => Module::t('note', 'Are you sure you want to archive the user?'),
                    ],
                ]);
            }elseif($model->activity_id === User::ACTIVITY_DISABLE_ID){
                echo Html::a(Module::t('app', 'Activate'), ['enable', 'id' => $model->id], [
                    'class' => 'btn btn-warning',
                    'data' => [
                        'confirm' => Module::t('note', 'Are you sure you want to activate the user?'),
                    ],
                ]);
            }
        ?>

        <?= Html::a(Module::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('note', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'surname',
            'name',

            [
                'attribute' => 'department_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->department->short_title,
                        Url::to(['/department/view', 'id' => $model->department_id]),
                        ['class' => 'btn btn-primary']);
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return date('j F, Y H:i:s', $model->created_at);
                }
            ],
            [
                'attribute' => 'role',
                'value' => function ($model) {
                    return $model->roleTitle;
                }
            ],
            [
                'attribute' => 'status_id',
                'value' => function ($model) {
                    return $model->status;
                }
            ],
            [
                'attribute' => 'activity_id',
                'value' => function ($model) {
                    return $model->activity;
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
