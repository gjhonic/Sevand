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
 */
class Group extends \yii\db\ActiveRecord
{
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
    public function rules()
    {
        return [
            [['title', 'course_id', 'department_id', 'direction_id', 'curator_id', 'headman_id'], 'required'],
            [['course_id', 'department_id', 'direction_id', 'curator_id', 'headman_id'], 'integer'],
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
            'headman_id' => Module::t('app', 'Headman'),
            'created_at' => Module::t('app', 'Created at'),
            'updated_at' => Module::t('app', 'Updated at'),
        ];
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
}
