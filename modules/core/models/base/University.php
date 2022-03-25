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
 *
 * @property Department[] $departments
 */
class University extends \yii\db\ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%core_university}}';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['title', 'short_title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['short_title'], 'string', 'max' => 10],
            [['description'], 'string'],
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
            'created_at' => Module::t('app', 'Created at'),
            'updated_at' => Module::t('app', 'Updated at'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Department::class, ['university_id' => 'id']);
    }
}
