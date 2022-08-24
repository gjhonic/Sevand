<?php

namespace app\modules\core\modules\api\models;

use app\modules\core\models\base\Student;
use app\modules\core\modules\api\ApiModule;
use Yii;

/**
 * Класс Студента Api
 */
class StudentApi extends Student
{
    /**
     * Возвращает студента по его id
     * @param int $id
     * @return array|\yii\db\ActiveRecord|null
     */
    public static function findById(int $id)
    {
        return self::find()->where([
            'id' => $id,
        ])->one();
    }

    /**
     * Метод пакует обьект студента в массив с нужным полями
     * @return array
     */
    public function getStudentInArrayApi(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'patronymic' => $this->patronymic,
            'status' => $this->activity,
            'user' => [
              'id' => $this->user_id,
              'username' => $this->user->username,
            ],
            'group' => [
                'id' => $this->group_id,
                'name' => $this->group->title,
                'course' => $this->group->course->title,
            ],
            'department' => [
                'id' => $this->department_id,
                'name' => $this->department->short_title,
            ],
        ];
    }
}