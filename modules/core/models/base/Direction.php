<?php

namespace app\modules\core\models\base;

use app\modules\core\Module;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "core_direction".
 *
 * @property int $id
 * @property string $title
 * @property string $short_title
 * @property string $description
 * @property int $department_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Department $department
 */
class Direction extends \yii\db\ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%core_direction}}';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['title', 'short_title', 'department_id'], 'required'],
            [['description'], 'string'],
            [['department_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['short_title'], 'string', 'max' => 100],
            [['created_at', 'updated_at'], 'safe'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * @return array
     */
    public function behaviors(): array
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
            'department_id' => Module::t('app', 'Department'),
            'created_at' => Module::t('app', 'Created at'),
            'updated_at' => Module::t('app', 'Updated at'),
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    public static function getDirectionMap(): array
    {
        $directions = static::find()->all();
        return ArrayHelper::map($directions, 'id', 'short_title');
    }
}
