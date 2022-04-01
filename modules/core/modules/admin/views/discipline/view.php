<?php

use app\modules\core\Module;
use app\modules\core\modules\admin\models\Discipline;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\Discipline */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Bases'), 'url' => ['/admin/bases']];
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Disciplines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="discipline-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Module::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('note', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?php
        if($model->activity_id === Discipline::ACTIVITY_ENABLE_ID){
            echo Html::a(Module::t('app', 'Deactivate'), ['disable', 'id' => $model->id], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => Module::t('note', 'Are you sure you want to archive the discipline?'),
                ],
            ]);
        }elseif($model->activity_id === Discipline::ACTIVITY_DISABLE_ID){
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
