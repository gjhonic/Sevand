<?php

use app\modules\core\models\base\Log;
use app\modules\core\Module;
use app\modules\core\modules\admin\components\IcoComponent;
use app\modules\core\services\log\LogStatus;
use kartik\dynagrid\DynaGrid;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \app\modules\core\modules\admin\models\search\LogSearch */

$this->title = Module::t('app', 'Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'message',
        [
            'label' => Module::t('app', 'Message with translation'),
            'value' => function ($model){
                return Module::t('log', $model->message);
            }
        ],
        [
            'attribute' => 'status_id',
            'format' => 'raw',
            'filter' => Log::getStatuses(),
            'value' => function ($model) {
                return LogStatus::getLabel($model->status_id);
            }
        ],
        [
            'attribute' => 'user_id',
            'format' => 'raw',
            'value' => function ($model) {
                $user = $model->user;
                if($user){
                    return Html::a($model->user->username, Url::to(['/admin/user/view', 'id' => $model->user_id]), ['class' => 'btn btn-secondary btn-block']);
                }
            }
        ],
        [
            'attribute' => 'description',
            'value' => function ($model) {
                return mb_substr($model->description, 0, 20) . ']...';
            }
        ],
        [
            'attribute' => 'created_at',
            'value' => function ($model) {
                return Yii::$app->formatter->asDatetime($model->created_at, "php:d.m.Y H:i:s");
            }
        ],
        [
            'label' => Module::t('app', 'Action column'),
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a(IcoComponent::view() . ' ' . Module::t('app', 'Show'), Url::to(['view', 'id' => $model->id]), ['class' => 'btn btn-success btn-block']);
            }
        ],
    ]; ?>

    <?= DynaGrid::widget(
        [
            'gridOptions' => [
                'resizeStorageKey' => 'Universities',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pjax' => true,
                'toolbar' => [
                    [
                        'content' =>
                            Html::a(
                                '<i class="glyphicon glyphicon-repeat"></i>',
                                ['index'],
                                [
                                    'data-pjax' => 0,
                                    'class' => 'btn btn-default',
                                    'title' => Module::t('app', 'Reset')
                                ]
                            ) .
                            Html::a(
                                '<i class="glyphicon glyphicon-print"></i>',
                                ['#'],
                                [
                                    'data-pjax' => 0,
                                    'class' => 'btn btn-default print-grid',
                                    'title' => Module::t('app', 'Print')
                                ]
                            ),
                    ],
                    ['content' => '{dynagridFilter}{dynagridSort}{dynagrid}'],
                    '{toggleData}',
                    '{export}',
                ],
                'panel' => [
                    'after' => false
                ],
                'exportConversions' => [
                    ['from_xls' => '-', 'to_xls' => '–'],
                ],
            ],
            'options' => [
                'id' => 'Universities'
            ],
            'columns' => $columns,
        ]
    );
    ?>
</div>
