<?php

use app\modules\core\models\base\Log;
use app\modules\core\Module;
use app\modules\core\services\log\LogService;
use kartik\dynagrid\DynaGrid;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \app\modules\core\models\search\LogSearch */

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
            'filter' => Log::getStatuses(),
            'value' => function ($model) {
                return $model->status;
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
            'attribute' => 'created_at',
            'value' => function ($model) {
                return Yii::$app->formatter->asDatetime($model->created_at, "php:d.m.Y H:i:s");
            }
        ],
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, Log $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            },
            'template' => '{view}',
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
