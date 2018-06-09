<?php

namespace frontend\modules\projects\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\projects\models\Train;

/**
 * TrainSearch represents the model behind the search form about `frontend\modules\projects\models\Train`.
 */
class TrainSearch extends Train
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Train_ID', ], 'integer'],
            [['Train_name', 'Train_type', 'Source_stn', 'Destination_stn'], 'safe'],
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
        $query = Train::find();

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

        $query->andFilterWhere(['like', 'Train_name', $this->Train_name])
            ->andFilterWhere(['like', 'Train_type', $this->Train_type])
            ->andFilterWhere(['like', 'Source_stn', $this->Source_stn])
            ->andFilterWhere(['like', 'Destination_stn', $this->Destination_stn]);

        return $dataProvider;
    }
}
