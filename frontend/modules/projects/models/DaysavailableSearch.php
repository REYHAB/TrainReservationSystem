<?php

namespace frontend\modules\projects\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\projects\models\Daysavailable;

/**
 * DaysavailableSearch represents the model behind the search form about `frontend\modules\projects\models\Daysavailable`.
 */
class DaysavailableSearch extends Daysavailable
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Train_ID'], 'integer'],
            [['Available_days'], 'safe'],
        ];
    }

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
        $query = Daysavailable::find();

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
            'Train_ID' => $this->Train_ID,
        ]);

        $query->andFilterWhere(['like', 'Available_days', $this->Available_days]);

        return $dataProvider;
    }
}
