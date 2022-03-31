<?php
/**
 * DisciplineSearch
 * Модель поиска дисциплин
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */
namespace app\modules\core\modules\admin\models\search;

use app\modules\core\modules\admin\models\Discipline;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class DisciplineSearch
 * @package app\modules\core\models\search
 *
 * @property integer $department_id
 */
class DisciplineSearch extends Discipline
{
    public $department_id;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['title', 'short_title'], 'string', 'max' => 255],
            [['id', 'department_id', 'activity_id'], 'integer'],
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
        $query->andWhere(['=', 'department_id', $this->department_id]);

        $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        if (!($this->load($params) && $this->validate()) && empty($this->tag_id)) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['=', 'id', $this->id]);
        $query->andFilterWhere(['like', 'short_title', $this->short_title]);
        $query->andFilterWhere(['=', 'activity_id', $this->activity_id]);

        return $dataProvider;
    }
}
