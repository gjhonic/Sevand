<?php
/**
 * UserSearch
 * Модель поиска пользователей
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */
namespace app\modules\core\models\search;

use app\modules\core\models\base\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class UserSearch extends User
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name', 'surname'], 'string', 'max' => 50],
            [['username'], 'string', 'max' => 255],
            [['status_id', 'department_id'], 'integer'],
            [['role'], 'string', 'max' => 15],
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
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        if (!($this->load($params) && $this->validate()) && empty($this->tag_id)) {
            return $dataProvider;
        }

        $query->joinWith("department");


        $query->andFilterWhere(['like', 'username', $this->username]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'surname', $this->surname]);
        $query->andFilterWhere(['=', 'role', $this->role]);
        $query->andFilterWhere(['=', 'status_id', $this->status_id]);

        if(!empty($this->department_id)){
            $query->andFilterWhere(['=', 'core_department.id', $this->department_id]);
        }

        return $dataProvider;
    }
}
