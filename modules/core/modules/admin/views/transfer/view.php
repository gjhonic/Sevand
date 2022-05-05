<?php

use app\modules\core\Module;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\StudentTransferLog */

$this->title = Module::t('app', 'Transfer') . ' №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Bases'), 'url' => ['/admin/bases']];
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Students Transfer Log'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="student-transfer-log-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => Module::t('app', 'Student'),
                'format' => 'raw',
                'value' => function ($model) {
                    $student = $model->student;
                    $htmlGroup = "<span style='color:red'>" . Module::t('app', 'Not set') . "</span>";
                    if($student){
                        $htmlGroup = Html::a($student->fullname,
                            Url::to(['student/view', 'id' => $model->student_id]),
                            ['class' => 'btn btn-outline-primary']);
                    }
                    return $htmlGroup;
                }
            ],
            [
                'attribute' => 'group_from_id',
                'format' => 'raw',
                'value' => function ($model) {
                    $groupFrom = $model->groupFrom;
                    $htmlGroupFrom = "<span style='color:red'>" . Module::t('app', 'Not set') . "</span>";
                    if ($groupFrom) {
                        $htmlGroupFrom = Html::a(
                            $groupFrom->title,
                            Url::to(['/admin/group/view', 'id' => $model->group_from_id]),
                            ['class' => 'btn btn-outline-secondary']
                        );
                    }
                    return $htmlGroupFrom;
                }
            ],
            [
                'attribute' => 'group_to_id',
                'format' => 'raw',
                'value' => function ($model) {
                    $groupTo = $model->groupTo;
                    $htmlGroupTo = "<span style='color:red'>" . Module::t('app', 'Not set') . "</span>";
                    if ($groupTo) {
                        $htmlGroupTo = Html::a(
                            $groupTo->title,
                            Url::to(['/admin/group/view', 'id' => $model->group_to_id]),
                            ['class' => 'btn btn-outline-secondary']
                        );
                    }
                    return $htmlGroupTo;
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
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return date('j F, Y H:i:s', $model->created_at);
                }
            ]
        ],
    ]) ?>

    <h3>
        <?=Module::t('app', 'Description')?>
    </h3>
    <div class="jumbotron">
        <?=$model->message?>
    </div>

</div>
