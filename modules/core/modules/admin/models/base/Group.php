<?php

namespace app\modules\core\modules\admin\models\base;

use app\modules\core\models\base\Group as GroupBase;
use Yii;

class Group extends GroupBase
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function find(): \yii\db\ActiveQuery
    {
        /* @var $user_identity User */
        $user_identity = Yii::$app->user->identity;
        return parent::find()->andWhere(['core_group.department_id' => $user_identity->department_id]);
    }
}
