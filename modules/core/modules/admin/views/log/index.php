<?php

use app\modules\core\models\base\Log;
use app\modules\core\Module;
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
            'attribute' => 'message',
            'label' => Module::t('app', 'Message with translation'),
            'value' => function ($model){
                return Module::t('log', $model->message);
            }
        ],
        [
            'attribute' => 'created_at',
            'value' => function ($model) {
                return date('j F, Y H:i:s', $model->created_at);
            }
        ],
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, Log $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            },
            'template' => '{view}  {update}',
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
