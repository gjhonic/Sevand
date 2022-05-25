<?php

namespace app\modules\core\modules\admin\forms;

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
     * Устанавливает факультет пользователя
     */
    public function setDepartmentFromUser()
    {
        $this->department_id = Yii::$app->user->identity->department_id;
    }

    public function __construct($config = [])
    {
        echo " - - - DUMP - - -";
        echo "<pre>";
        print_r(123);
        echo "</pre>";
        echo "- - - - - - - - -";
        die;

        parent::__construct($config);
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
