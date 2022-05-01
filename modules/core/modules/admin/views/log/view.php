<?php

use app\modules\core\Module;
use app\modules\core\services\log\LogStatus;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\Log */

$this->title = Module::t('app', 'Log') . ' №' . $model->id;
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
                    $user = $model->user;
                    if($user){
                        return Html::a($model->user->username, Url::to(['/admin/user/view', 'id' => $model->user_id]), ['class' => 'btn btn-secondary']);
                    }
                }
            ],
            'message:ntext',
            [
                'attribute' => 'status_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return LogStatus::getLabel($model->status_id);
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->created_at, "php:d.m.Y H:i:s");
                }
            ],
        ],
    ]) ?>

    <h3>
        <?=Module::t('app', 'Description')?>
    </h3>
    <div class="jumbotron">
        <?=$model->description?>
    </div>

</div>
