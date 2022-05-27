<?php

namespace app\modules\core\modules\admin\models\forms;

use app\modules\core\Module;
use Yii;
use yii\base\Model;

class GenerateDiscipline extends Model
{
    public $text_discipline;
    public $department_id;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['text_discipline'], 'required'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'text_discipline' => '',
        ];
    }



    /**
     * Устанавливает факультет пользователя
     */
    public function setDepartmentFromUser()
    {
        $this->department_id = Yii::$app->user->identity->department_id;
    }

    /**
     * Генерирует
     * @return false
     */
    public function generate()
    {
        return false;
    }
}
