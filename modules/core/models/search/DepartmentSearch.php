<?php
/**
 * DepartmentSearch
 * Модель поиска факультетов
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */
namespace app\modules\core\models\search;

use app\modules\core\models\base\Department;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class DepartmentSearch extends Department
{
    public $university_id;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['title', 'short_title'], 'string', 'max' => 255],
            [['university_id'], 'integer'],
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
        $query = Department::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        if (!($this->load($params) && $this->validate()) && empty($this->tag_id)) {
            return $dataProvider;
        }

        $query->joinWith('university');

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'short_title', $this->short_title]);

        if(!empty($this->university_id)){
            $query->andFilterWhere(['=', 'core_university.id', $this->university_id]);
        }

        return $dataProvider;
    }
}
