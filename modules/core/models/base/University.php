<?php

namespace app\modules\core\models\base;

use app\modules\core\Module;
use Yii;

/**
 * This is the model class for table "core_university".
 *
 * @property int $id
 * @property string $title
 * @property string $short_title
 * @property string|null $description
 */
class University extends \yii\db\ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'core_university';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['title', 'short_title'], 'required'],
            [['title', 'description'], 'string', 'max' => 255],
            [['short_title'], 'string', 'max' => 10],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('app', 'ID'),
            'title' => Module::t('app', 'Title'),
            'short_title' => Module::t('app', 'Short title'),
            'description' => Module::t('app', 'Description'),
        ];
    }
}
