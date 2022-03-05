<?php

use app\modules\core\models\base\Discipline;
use app\modules\core\Module;
use kartik\dynagrid\DynaGrid;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \app\modules\core\models\search\DisciplineSearch */

$this->title = Module::t('app', 'Disciplines');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discipline-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('app', 'Create Discipline'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'title',
        'short_title',
        [
            'attribute' => 'department_id',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a($model->department->short_title,
                    Url::to(['/admin/department/view', 'id' => $model->department_id]),
                    ['class' => 'btn btn-secondary']);
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
        ],
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, Discipline $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            },
            'template'=>'{view}  {update}',
        ],
    ]; ?>

    <?= DynaGrid::widget([
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
    ]);
    ?>


</div>
