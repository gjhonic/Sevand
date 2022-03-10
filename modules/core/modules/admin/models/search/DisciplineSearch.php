<?php
/**
 * DisciplineSearch
 * Модель поиска дисциплин
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */
namespace app\modules\core\modules\admin\models\search;

use app\modules\core\models\base\Discipline;
use app\modules\core\modules\admin\models\base\Direction;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class DisciplineSearch
 * @package app\modules\core\models\search
 *
 * @property integer $department_id
 */
class DisciplineSearch extends Direction
{
    public $department_id;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['title', 'short_title'], 'string', 'max' => 255],
            [['id', 'department_id'], 'integer'],
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
        $query = Discipline::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        if (!($this->load($params) && $this->validate()) && empty($this->tag_id)) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['=', 'id', $this->id]);
        $query->andFilterWhere(['like', 'short_title', $this->short_title]);

        if(!empty($this->department_id)){
            $query->andFilterWhere(['=', 'department_id', $this->department_id]);
        }

        return $dataProvider;
    }
}
