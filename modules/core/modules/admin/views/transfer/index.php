<?php

use app\modules\core\Module;
use app\modules\core\modules\admin\components\IcoComponent;
use app\modules\core\modules\admin\models\Group;
use kartik\dynagrid\DynaGrid;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \app\modules\core\modules\admin\models\search\LogSearch */

$this->title = Module::t('app', 'Students Transfer Log');
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Bases'), 'url' => ['/admin/bases']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-transfer-lot-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(
            IcoComponent::base() . ' ' . Module::t('app', 'Student base'),
            ['student/index'],
            ['class' => 'btn btn-success']
        ) ?>
    </p>

    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        [
            'attribute' => 'student_id',
            'format' => 'raw',
            'value' => function ($model) {
                $student = $model->student;
                $htmlGroup = "<span style='color:red'>" . Module::t('app', 'Not set') . "</span>";
                if($student){
                    $htmlGroup = Html::a($student->fullname,
                        Url::to(['student/view', 'id' => $model->student_id]),
                        ['class' => 'btn btn-primary']);
                }
                return $htmlGroup;
            }
        ],
        [
            'attribute' => 'group_from_id',
            'filter' => Group::getGroupsMap(),
            'format' => 'raw',
            'value' => function ($model) {
                $groupFrom = $model->groupFrom;
                $htmlGroupFrom = "<span style='color:red'>" . Module::t('app', 'Not set') . "</span>";
                if ($groupFrom) {
                    $htmlGroupFrom = Html::a(
                        $groupFrom->title,
                        Url::to(['/admin/group/view', 'id' => $model->group_from_id]),
                        ['class' => 'btn btn-secondary btn-block']
                    );
                }
                return $htmlGroupFrom;
            }
        ],
        [
            'attribute' => 'group_to_id',
            'filter' => Group::getGroupsMap(),
            'format' => 'raw',
            'value' => function ($model) {
                $groupTo = $model->groupTo;
                $htmlGroupTo = "<span style='color:red'>" . Module::t('app', 'Not set') . "</span>";
                if ($groupTo) {
                    $htmlGroupTo = Html::a(
                        $groupTo->title,
                        Url::to(['/admin/group/view', 'id' => $model->group_to_id]),
                        ['class' => 'btn btn-secondary btn-block']
                    );
                }
                return $htmlGroupTo;
            }
        ],
        [
            'attribute' => 'message',
            'value' => function ($model) {
                return mb_substr($model->message, 0, 20) . ']...';
            }
        ],
        [
            'attribute' => 'user_id',
            'format' => 'raw',
            'value' => function ($model) {
                $user = $model->user;
                $htmlUser = "<span style='color:red'>" . Module::t('app', 'Not set') . "</span>";
                if ($user) {
                    $htmlUser = Html::a(
                        $user->fullname,
                        Url::to(['/admin/user/view', 'id' => $model->user_id]),
                        ['class' => 'btn btn-secondary btn-block']
                    );
                }
                return $htmlUser;

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
