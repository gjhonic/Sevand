<?php

use app\modules\core\models\base\User;
use app\modules\core\Module;
use kartik\dynagrid\DynaGrid;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \app\modules\core\modules\admin\models\search\UserSearch */

$this->title = Module::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'username',
        'surname',
        'name',

        [
            'attribute' => 'status_id',
            'filter' => User::getStatuses(),
            'value' => function ($model) {
                return $model->status;
            }
        ],
        [
            'attribute' => 'role',
            'filter' => User::getRoles(),
            'value' => function ($model) {
                return $model->role;
            }
        ],
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, User $model, $key, $index, $column) {
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
