<?php

namespace app\modules\core\models\base;

use app\modules\core\Module;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "core_university".
 *
 * @property int $id
 * @property string $title
 * @property string $short_title
 * @property string $description
 * @property int $created_at
 * @property int $updated_at
 */
class University extends \yii\db\ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%core_university}}';
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
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
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
