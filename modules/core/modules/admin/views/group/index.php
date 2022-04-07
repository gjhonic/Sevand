<?php

use app\modules\core\models\base\Course;
use app\modules\core\modules\admin\components\IcoComponent;
use app\modules\core\modules\admin\models\Direction;
use app\modules\core\modules\admin\models\Group;
use app\modules\core\Module;
use app\modules\core\modules\admin\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \app\modules\core\modules\admin\models\search\UserSearch */

$this->title = Module::t('app', 'Groups');
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Bases'), 'url' => ['/admin/bases']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(Yii::$app->user->identity->role !== User::ROLE_MODERATOR) { ?>
            <?= Html::a(IcoComponent::add() . ' ' . Module::t('app', 'Create Group'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>

    <?php

    $columns = [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'title',
        [
            'attribute' => 'course_id',
            'filter' => Course::getCourseMap(),
            'value' => function ($model) {
                return $model->course->title;
            }
        ],
        [
            'attribute' => 'direction_id',
            'filter' => Direction::getDirectionMap(),
            'value' => function ($model) {
                return $model->direction->short_title;
            }
        ],
        [
            'attribute' => 'activity_id',
            'filter' => Group::getAtivities(),
            'value' => function ($model) {
                return $model->activity;
            }
        ],
        [
            'label' => Module::t('app', 'Action column'),
            'format' => 'raw',
            'value' => function ($model) {
                $html = Html::a(IcoComponent::view() . ' ' . Module::t('app', 'Show'), Url::to(['view', 'id' => $model->id]), ['class' => 'btn btn-success btn-block']);

                if(Yii::$app->user->identity->role !== User::ROLE_MODERATOR){
                    $html .= ' ' . Html::a(IcoComponent::edit() . ' ' .Module::t('app', 'Edit'), Url::to(['update', 'id' => $model->id]), ['class' => 'btn btn-primary btn-block']);
                    $html .= ' ' . Html::a(IcoComponent::delete() . ' ' . Module::t('app', 'Delete'), Url::to(['delete', 'id' => $model->id]), [
                            'class' => 'btn btn-danger btn-block',
                            'data' => [
                                'confirm' => Module::t('note', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]);
                }

                return $html;
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
