<?php
/**
 * StudentTransferLogSearch
 * Модель поиска истории переводов
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */
namespace app\modules\core\modules\admin\models\search;

use app\modules\core\modules\admin\models\StudentTransferLog;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class StudentTransferLogSearch
 * @package app\modules\core\modules\admin\models\search
 *
 * @property integer $department_id
 */
class StudentTransferLogSearch extends StudentTransferLog
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['message'], 'string'],
            [['id', 'group_from_id', 'group_to_id'], 'integer'],
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
        $query = StudentTransferLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andFilterWhere(['=', 'department_id', $this->department_id]);

        $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        if (!($this->load($params) && $this->validate()) && empty($this->tag_id)) {
            return $dataProvider;
        }

        $query->andFilterWhere(['=', 'id', $this->id]);
        $query->andFilterWhere(['like', 'message', $this->message]);
        $query->andFilterWhere(['=', 'group_from_id', $this->group_from_id]);
        $query->andFilterWhere(['=', 'group_to_id', $this->group_to_id]);
        return $dataProvider;
    }
}
