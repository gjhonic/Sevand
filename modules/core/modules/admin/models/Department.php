<?php

namespace app\modules\core\modules\admin\models;

use app\modules\core\models\base\Department as BaseDepartment;
use Yii;

class Department extends BaseDepartment
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function find(): \yii\db\ActiveQuery
    {
        /* @var $user_identity User */
        $user_identity = Yii::$app->user->identity;
        return parent::find()->andWhere(['core_direction.department_id' => $user_identity->department_id]);
    }
}
