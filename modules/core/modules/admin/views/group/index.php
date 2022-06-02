<?php

use app\modules\core\modules\admin\components\ActivityComponent;
use app\modules\core\modules\admin\components\IcoComponent;
use app\modules\core\modules\admin\models\Direction;
use app\modules\core\Module;
use app\modules\core\modules\admin\models\Student;
use app\modules\core\modules\admin\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\dynagrid\DynaGrid;

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
        <?php
        if (Yii::$app->user->identity->role !== User::ROLE_MODERATOR) { ?>
            <?= Html::a(
                IcoComponent::add() . ' ' . Module::t('app', 'Create Group'),
                ['create'],
                ['class' => 'btn btn-success']
            ) ?>
        <?php
        } ?>
    </p>

    <?php

    $columns = [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'title',
        [
            'attribute' => 'course_id',
            'filter' => Direction::getDirectionMap(),
            'format' => 'raw',
            'value' => function ($model) {
                $course = $model->course;
                if ($course) {
                    return Html::a(
                        $course->title,
                        Url::to(['/admin/course/view', 'id' => $model->course_id]),
                        ['class' => 'btn btn-secondary btn-block']
                    );
                }
            }
        ],
        [
            'attribute' => 'direction_id',
            'filter' => Direction::getDirectionMap(),
            'format' => 'raw',
            'value' => function ($model) {
                $direction = $model->direction;
                if ($direction) {
                    return Html::a(
                        $direction->short_title,
                        Url::to(['/admin/direction/view', 'id' => $model->direction_id]),
                        ['class' => 'btn btn-secondary btn-block']
                    );
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
            'attribute' => 'activity_id',
            'format' => 'raw',
            'filter' => Student::getAtivities(),
            'value' => function ($model) {
                return ActivityComponent::getLabel($model->activity_id);
            }
        ],
        [
            'label' => Module::t('app', 'Action column'),
            'format' => 'raw',
            'value' => function ($model) {
                $html = Html::a(
                    IcoComponent::view() . ' ' . Module::t('app', 'Show'),
                    Url::to(['view', 'id' => $model->id]),
                    ['class' => 'btn btn-success btn-block']
                );

                if (Yii::$app->user->identity->role !== User::ROLE_MODERATOR) {
                    $html .= ' ' . Html::a(
                            IcoComponent::edit() . ' ' . Module::t('app', 'Edit'),
                            Url::to(['update', 'id' => $model->id]),
                            ['class' => 'btn btn-primary btn-block']
                        );
                    $html .= ' ' . Html::a(
                            IcoComponent::delete() . ' ' . Module::t('app', 'Delete'),
                            Url::to(['delete', 'id' => $model->id]),
                            [
                                'class' => 'btn btn-danger btn-block',
                                'data' => [
                                    'confirm' => Module::t('note', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                            ]
                        );
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
