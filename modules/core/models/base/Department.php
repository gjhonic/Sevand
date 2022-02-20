<?php

namespace app\modules\core\models\base;

use app\modules\core\Module;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "core_department".
 *
 * @property int $id
 * @property string $title
 * @property string $short_title
 * @property string $description
 * @property int $university_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property University $university
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'core_department';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['title', 'short_title', 'university_id'], 'required'],
            [['university_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['short_title'], 'string', 'max' => 10],
            [['created_at', 'updated_at'], 'safe'],
            [['university_id'], 'exist', 'skipOnError' => true, 'targetClass' => University::className(), 'targetAttribute' => ['university_id' => 'id']],
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
            'short_title' => Module::t('app', 'Short title'),
            'description' => Module::t('app', 'Description'),
            'university_id' => Module::t('app', 'University'),
            'created_at' => Module::t('app', 'Created at'),
            'updated_at' => Module::t('app', 'Updated at'),
        ];
    }

    /**
     * Gets query for [[University]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUniversity(): \yii\db\ActiveQuery
    {
        return $this->hasOne(University::className(), ['id' => 'university_id']);
    }

    /**
     * Возвразает факультеты сгрупированные по университетам
     * @return array
     */
    public static function getDepartmentGroup(): array
    {
        $universities = University::find()->all();
        $departmentGroup = [];
        foreach ($universities as $university){
            $departmentGroup[$university->short_title] = ArrayHelper::map($university->departments, 'id', 'short_title');
        }
        return $departmentGroup;
    }
}
