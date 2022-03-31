<?php

namespace app\modules\core\modules\admin\models;

use app\modules\core\models\base\Student as BaseStudent;
use Yii;


class Student extends BaseStudent
{
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->setDepartmentFromUser();
            } else {
                if($this->department_id !== Yii::$app->user->identity->department_id){
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function find(): \yii\db\ActiveQuery
    {
        /* @var $user_identity self */
        $user_identity = Yii::$app->user->identity;
        return parent::find()->andWhere(['core_student.department_id' => $user_identity->department_id]);
    }

    /**
     * Устанавливает факультет пользователя
     */
    public function setDepartmentFromUser()
    {
        $this->department_id = Yii::$app->user->identity->department_id;
    }
}
