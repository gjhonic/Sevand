<?php

use app\modules\core\Module;
use app\modules\core\services\LogService;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\Log */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="log-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->user->username,
                                   Url::to(['/user/view', 'id' => $model->user_id]),
                                   ['class' => 'btn btn-primary']);
                }
            ],
            [
                'attribute' => 'department_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->department->short_title,
                                   Url::to(['/department/view', 'id' => $model->department_id]),
                                   ['class' => 'btn btn-primary']);
                }
            ],
            'message:ntext',
            [
                'attribute' => 'message',
                'label' => Module::t('app', 'Message with translation'),
                'value' => function ($model){
                    return Module::t('log', $model->message);
                }
            ],
            [
                'attribute' => 'status_id',
                'value' => function ($model){
                    return LogService::getStatus($model->status_id);
                }
            ],
            'description:ntext',
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return date('j F, Y H:i:s', $model->created_at);
                }
            ],
        ],
    ]) ?>

</div>
