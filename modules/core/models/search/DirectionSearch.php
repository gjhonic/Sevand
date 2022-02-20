<?php
/**
 * DirectionSearch
 * Модель поиска направлений подготовки
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */
namespace app\modules\core\models\search;

use app\modules\core\models\base\Direction;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class DirectionSearch
 * @package app\modules\core\models\search
 *
 * @property integer $department_id
 */
class DirectionSearch extends Direction
{
    public $department_id;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['title', 'short_title'], 'string', 'max' => 255],
            [['department_id'], 'integer'],
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
        $query = Direction::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        if (!($this->load($params) && $this->validate()) && empty($this->tag_id)) {
            return $dataProvider;
        }

        $query->joinWith('department');

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'short_title', $this->short_title]);

        if(!empty($this->department_id)){
            $query->andFilterWhere(['=', 'core_department.id', $this->department_id]);
        }

        return $dataProvider;
    }
}
