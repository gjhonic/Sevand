<?php
/**
 * StudentSearch
 * Модель поиска логов
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */
namespace app\modules\core\modules\admin\models\search;

use app\modules\core\models\base\Student;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class StudentSearch
 * @package app\modules\core\modules\admin\models\search
 *
 * @property integer $department_id
 */
class StudentSearch extends Student
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name', 'surname', 'patronymic'], 'string', 'max' => 50],
            [['status_id', 'department_id', 'gender', 'group_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Student::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andFilterWhere(['=', 'department_id', $this->department_id]);

        $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        if (!($this->load($params) && $this->validate()) && empty($this->tag_id)) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'surname', $this->surname]);
        $query->andFilterWhere(['like', 'patronymic', $this->patronymic]);

        $query->andFilterWhere(['=', 'gender', $this->gender]);


        $query->andFilterWhere(['=', 'status_id', $this->status_id]);
        $query->andFilterWhere(['=', 'group_id', $this->group_id]);

        return $dataProvider;
    }
}
