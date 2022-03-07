<?php

namespace app\modules\core\modules\admin\models\base;

use app\modules\core\models\base\Direction as BaseDirection;
use Yii;

class Direction extends BaseDirection
{

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->setDepartmentFromUser();
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Устанавливает факультет пользователя
     */
    public function setDepartmentFromUser()
    {
        $this->department_id = Yii::$app->user->identity->department_id;
    }
}
