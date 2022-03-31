<?php
/**
 * DirectionSearch
 * Модель поиска направлений подготовки
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */
namespace app\modules\core\modules\admin\models\search;

use app\modules\core\modules\admin\models\Direction;
use Yii;
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

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['title', 'short_title'], 'string', 'max' => 255],
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
        $query->andWhere(['=', 'department_id', Yii::$app->user->identity->department_id]);

        $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        if (!($this->load($params) && $this->validate()) && empty($this->tag_id)) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'short_title', $this->short_title]);

        return $dataProvider;
    }
}
