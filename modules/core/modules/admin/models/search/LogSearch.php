<?php
/**
 * LogSearch
 * Модель поиска логов
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */
namespace app\modules\core\modules\admin\models\search;

use app\modules\core\modules\admin\models\Log;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class LogSearch
 * @package app\modules\core\modules\admin\models\search
 *
 * @property integer $department_id
 */
class LogSearch extends Log
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['message', 'description'], 'string', 'max' => 255],
            [['id', 'status_id'], 'integer'],
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
        $query = Log::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        if (!($this->load($params) && $this->validate()) && empty($this->tag_id)) {
            return $dataProvider;
        }
        $query->andFilterWhere(['=', 'id', $this->id]);
        $query->andFilterWhere(['like', 'message', $this->message]);
        $query->andFilterWhere(['like', 'description', $this->description]);
        $query->andFilterWhere(['=', 'status_id', $this->status_id]);

        return $dataProvider;
    }
}
