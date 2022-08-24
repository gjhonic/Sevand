<?php

use app\modules\core\Module;
use app\modules\core\modules\admin\components\ActivityComponent;
use app\modules\core\modules\admin\components\IcoComponent;
use app\modules\core\modules\admin\models\Student;
use app\modules\core\modules\admin\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\Student */

$this->title = Module::t('app', 'Student') . ': ' . $model->fullname;
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Bases'), 'url' => ['/admin/bases']];
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Students'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="student-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="col-md-12">
    <div class="row">
        <?php if (Yii::$app->user->identity->role !== User::ROLE_MODERATOR) { ?>
            <div class="col">
                <?= Html::a(IcoComponent::edit() . ' ' . Module::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-block']) ?>
            </div>
        <?php } ?>

        <div class="col">
            <?php if ($model->activity_id === Student::ACTIVITY_ENABLE_ID) {
                echo Html::a(
                    IcoComponent::disable() . ' ' . Module::t('app', 'To archive'),
                    ['disable', 'id' => $model->id],
                    [
                        'class' => 'btn btn-warning btn-block',
                        'data' => [
                            'confirm' => Module::t('note', 'Are you sure you want to archive the student?'),
                        ],
                    ]
                );
            } elseif ($model->activity_id === Student::ACTIVITY_DISABLE_ID) {
                echo Html::a(
                    IcoComponent::enable() . ' ' . Module::t('app', 'Activate'),
                    ['enable', 'id' => $model->id],
                    [
                        'class' => 'btn btn-warning btn-block',
                        'data' => [
                            'confirm' => Module::t('note', 'Are you sure you want to activate the student?'),
                        ],
                    ]
                );
            } ?>
        </div>

        <?php if (Yii::$app->user->identity->role !== User::ROLE_MODERATOR) { ?>
            <div class="col">
                <?= Html::a(IcoComponent::transfer() . ' ' . Module::t('app', 'Transfer Student'),
                    ['transfer', 'id' => $model->id],
                    ['class' => 'btn btn-secondary btn-block'])
                ?>
            </div>
        <?php } ?>

        <div class="col">
            <?= Html::a( Module::t('app', 'View history transfer'),
                ['transfer/student-transfer', 'id' => $model->id],
                ['class' => 'btn btn-info btn-block'])
            ?>
        </div>

        <?php if (Yii::$app->user->identity->role !== User::ROLE_ADMIN) { ?>
            <div class="col">
                <?= Html::a(IcoComponent::delete() . ' ' . Module::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-block',
                    'data' => [
                        'confirm' => Module::t('note', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        <?php } ?>

    </div>
    </div>
    <br>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'surname',
            'patronymic',
            'genderTitle',
            [
                'attribute' => 'group_id',
                'format' => 'raw',
                'value' => function ($model) {
                    $group = $model->group;
                    $htmlGroup = "<span style='color:red'>" . Module::t('app', 'Not set') . "</span>";
                    if($group){
                        $htmlGroup = Html::a($group->title,
                            Url::to(['group/view', 'id' => $model->group_id]),
                            ['class' => 'btn btn-outline-primary']);
                    }
                    return $htmlGroup;
                }
            ],
            [
                'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function ($model) {
                    $user = $model->user;
                    $htmlUser = "<span style='color:red'>" . Module::t('app', 'Not set') . "</span>";
                    if($user){
                        $htmlUser = Html::a($user->fullname,
                                   Url::to(['user/view', 'id' => $model->user_id]),
                                   ['class' => 'btn btn-outline-primary']);
                    }
                    return $htmlUser;
                }
            ],
            [
                'attribute' => 'department_id',
                'format' => 'raw',
                'value' => function ($model) {
                    $department =  $model->department;
                    $htmlDepartment = "<span style='color:red'>" . Module::t('app', 'Not set') . "</span>";
                    if ($department) {
                        $htmlDepartment =  Html::a($department->short_title,
                                Url::to(['department/view', 'id' => $model->department_id]),
                                ['class' => 'btn btn-outline-primary']);
                    }

                    return $htmlDepartment;
                }
            ],
            [
                'attribute' => 'activity_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return ActivityComponent::getLabel($model->activity_id);
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
            ]
        ],
    ]) ?>

    <h3>
        <?=Module::t('app', 'Description')?>
    </h3>
    <div class="jumbotron">
        <?=$model->description?>
    </div>

</div>
