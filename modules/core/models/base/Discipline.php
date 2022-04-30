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
 * @property int $activity_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Department $department
 * @property string $activity
 * @property string $info
 */
class Discipline extends \yii\db\ActiveRecord
{
    //Активность дисциплины
    const ACTIVITY_ENABLE_ID = 1;
    const ACTIVITY_ENABLE = 'Active';

    const ACTIVITY_DISABLE_ID = 2;
    const ACTIVITY_DISABLE = 'Not active';

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%core_discipline}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['title', 'short_title', 'department_id'], 'required'],
            [['department_id', 'activity_id'], 'integer'],
            ['activity_id', 'default', 'value' => 1],
            [['title'], 'string', 'max' => 255],
            [['short_title'], 'string', 'max' => 50],
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
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Module::t('app', 'ID'),
            'title' => Module::t('app', 'Title'),
            'short_title' => Module::t('app', 'Short title'),
            'department_id' => Module::t('app', 'Department'),
            'activity_id' => Module::t('app', 'Activity'),
            'created_at' => Module::t('app', 'Created at'),
            'updated_at' => Module::t('app', 'Updated at'),
        ];
    }

    /**
     * Возврщает мап активности
     * @return array
     */
    public static function getAtivities(): array
    {
        return [
            self::ACTIVITY_ENABLE_ID => Module::t('app', self::ACTIVITY_ENABLE),
            self::ACTIVITY_DISABLE_ID => Module::t('app', self::ACTIVITY_DISABLE),
        ];
    }

    /**
     * Возвращает статус дисциплины
     * @return string
     */
    public function getActivity(): string
    {
        return self::getAtivities()[$this->activity_id];
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

    /**
     * Метод активирует дисциплину
     * @return bool
     */
    public function enable(): bool
    {
        $this->activity_id = self::ACTIVITY_ENABLE_ID;
        return $this->save(false);
    }

    /**
     * Метод деактивирует дисциплину
     * @return bool
     */
    public function disable(): bool
    {
        $this->activity_id = self::ACTIVITY_DISABLE_ID;
        return $this->save(false);
    }

    /**
     * Метод возвращает информацию о дисциплине
     */
    public function getInfo(): string
    {
        return 'id: ' . $this->id .
            ' title: ' . $this->title .
            ' short_title: ' . $this->short_title;
    }
}
