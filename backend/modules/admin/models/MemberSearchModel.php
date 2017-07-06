<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MemberModel;

/**
 * AdminSearchModel represents the model behind the search form about `backend\models\AdminModel`.
 */
class MemberSearchModel extends MemberModel
{
    /**
     * @inheritdoc
     */
//    public function rules()
//    {
//        return [
//            [['id', 'level','add_type'], 'integer'],
//            [['user_name', 'hash_password'], 'safe'],
//            [['real_name', 'bank_card'], 'safe'],
//        ];
//    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
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
        $query = MemberModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'level' => $this->level,
            'add_type' => $this->level,
        ]);

        $query->andFilterWhere(['like', 'real_name', $this->real_name])
            ->andFilterWhere(['like', 'bank_card', $this->bank_card]);

        return $dataProvider;
    }
}
