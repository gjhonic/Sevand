<?php
namespace app\modules\core\services\user;

use app\modules\core\models\base\Student;
use Yii;

/**
 * Сервис для работы со студентами
 */
class StudentService
{
    /**
     * Возвращает студента
     * @param int $id
     * @return \yii\db\ActiveQuery
     */
    public function getStudent(int $id)
    {
        /* @var $user_identity self */
        $user_identity = Yii::$app->user->identity;
        return Student::find()->andWhere([
            'id' => $id,
            'core_student.department_id' => $user_identity->department_id
        ]);
    }
}