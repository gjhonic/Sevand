<?php

use app\modules\core\Module;
use app\modules\core\modules\admin\components\IcoComponent;
use app\modules\core\modules\admin\models\Group;
use app\modules\core\modules\admin\models\Student;
use app\modules\core\modules\admin\models\User;
use kartik\dynagrid\DynaGrid;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \app\modules\core\models\search\StudentSearch */

$this->title = Module::t('app', 'Students');
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Bases'), 'url' => ['/admin/bases']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if (Yii::$app->user->identity->role !== User::ROLE_MODERATOR) { ?>
            <?= Html::a(
                IcoComponent::add() . ' ' . Module::t('app', 'Create Student'),
                ['user/create-student'],
                ['class' => 'btn btn-success']
            ) ?>
            <?php
        } ?>
    </p>

    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'surname',
        'name',
        'patronymic',
        [
            'attribute' => 'gender',
            'filter' => Student::getGendersMap(),
            'value' => function ($model) {
                return $model->genderTitle;
            }
        ],
        [
            'attribute' => 'group_id',
            'filter' => Group::getGroupsMap(),
            'format' => 'raw',
            'value' => function ($model) {
                $group = $model->group;
                if ($group) {
                    return Html::a(
                        $group->title,
                        Url::to(['/admin/group/view', 'id' => $model->group_id]),
                        ['class' => 'btn btn-secondary btn-block']
                    );
                }
            }
        ],
        [
            'attribute' => 'user_id',
            'format' => 'raw',
            'value' => function ($model) {
                $user = $model->user;
                if ($user) {
                    return Html::a(
                        $user->getFullname(),
                        Url::to(['/admin/user/view', 'id' => $model->user_id]),
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
            'attribute' => 'updated_at',
            'value' => function ($model) {
                return Yii::$app->formatter->asDatetime($model->updated_at, "php:d.m.Y H:i:s");
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
                                    'method' => 'post'
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
                'id' => 'Users'
            ],
            'columns' => $columns,
        ]
    );
    ?>


</div>
