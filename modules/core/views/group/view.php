<?php

use app\modules\core\Module;
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
        <?= Html::a(Module::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
