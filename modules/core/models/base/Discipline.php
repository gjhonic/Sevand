<?php

namespace app\modules\core\models\base;

use app\modules\core\Module;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "core_discipline".
 *
 * @property int $id
 * @property string $title
 * @property string $short_title
 * @property int $department_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Department $department
 */
class Discipline extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%core_discipline}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'short_title', 'department_id'], 'required'],
            [['department_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['short_title'], 'string', 'max' => 50],
            [[ 'created_at', 'updated_at'], 'safe'],
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
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('app', 'ID'),
            'title' => Module::t('app', 'Title'),
            'short_title' => Module::t('app', 'Short title'),
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
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }
}
