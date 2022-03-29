<?php

namespace app\modules\core\models\base;

use app\modules\core\Module;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "core_group".
 *
 * @property int $id
 * @property string $title
 * @property int $course_id
 * @property int $department_id
 * @property int $direction_id
 * @property int $activity_id
 * @property int $curator_id
 * @property int $headman_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Course $course
 * @property User $curator
 * @property Department $department
 * @property Direction $direction
 * @property User $headman
 * @property string $activity
 */
class Group extends \yii\db\ActiveRecord
{

    //Активность группы
    const ACTIVITY_ENABLE_ID = 1;
    const ACTIVITY_ENABLE = 'Active';

    const ACTIVITY_DISABLE_ID = 2;
    const ACTIVITY_DISABLE = 'Not active';

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%core_group}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['title', 'course_id', 'department_id', 'direction_id', 'curator_id', 'headman_id'], 'required'],
            [['course_id', 'department_id', 'direction_id', 'curator_id', 'headman_id', 'activity_id'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['created_at', 'updated_at'], 'safe'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['curator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['curator_id' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['direction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direction::className(), 'targetAttribute' => ['direction_id' => 'id']],
            [['headman_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['headman_id' => 'id']],
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
    public function attributeLabels(): array
    {
        return [
            'id' => Module::t('app', 'ID'),
            'title' => Module::t('app', 'Title'),
            'course_id' => Module::t('app', 'Course'),
            'department_id' => Module::t('app', 'Department'),
            'direction_id' => Module::t('app', 'Direction'),
            'curator_id' => Module::t('app', 'Curator'),
            'activity_id' => Module::t('app', 'Activity'),
            'headman_id' => Module::t('app', 'Headman'),
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
     * Возвращает статус пользователя
     * @return string
     */
    public function getActivity(): string
    {
        return self::getAtivities()[$this->activity_id];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    /**
     * Gets query for [[Curator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurator()
    {
        return $this->hasOne(User::className(), ['id' => 'curator_id']);
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
     * Gets query for [[Direction]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirection()
    {
        return $this->hasOne(Direction::className(), ['id' => 'direction_id']);
    }

    /**
     * Gets query for [[Headman]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHeadman()
    {
        return $this->hasOne(User::className(), ['id' => 'headman_id']);
    }

    /**
     * Метод активирует группу
     * @return bool
     */
    public function enable(): bool
    {
        $this->activity_id = self::ACTIVITY_ENABLE_ID;
        return $this->save(false);
    }

    /**
     * Метод деактивирует группу
     * @return bool
     */
    public function disable(): bool
    {
        $this->activity_id = self::ACTIVITY_DISABLE_ID;
        return $this->save(false);
    }
}
