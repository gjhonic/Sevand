<?php
/**
 * GroupSearch
 * Модель поиска групп
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */

namespace app\modules\core\modules\admin\models\search;

use app\modules\core\modules\admin\models\base\Group;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class GroupSearch
 * @package app\modules\core\modules\admin\models\search
 *
 * @property integer $department_id
 */
class GroupSearch extends Group
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['title'], 'string', 'max' => 255],
            [['id', 'course_id', 'direction_id'], 'integer'],
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
        $query = Group::find();

        $dataProvider = new ActiveDataProvider(['query' => $query]);
        $query->andWhere(['=', 'department_id', Yii::$app->user->identity->department_id]);

        $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        if (!($this->load($params) && $this->validate()) && empty($this->tag_id)) {
            return $dataProvider;
        }
        $query->andFilterWhere(['=', 'id', $this->id]);
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['=', 'course_id', $this->course_id]);
        $query->andFilterWhere(['=', 'direction_id', $this->direction_id]);

        return $dataProvider;
    }
}
