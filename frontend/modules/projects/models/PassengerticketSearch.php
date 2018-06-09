<?php

namespace frontend\modules\projects\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\projects\models\Passengerticket;

/**
 * PassengerticketSearch represents the model behind the search form about `frontend\modules\projects\models\Passengerticket`.
 */
class PassengerticketSearch extends Passengerticket
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PNR', 'Class_type', 'Reservation_status'], 'safe'],
            [['Source_ID', 'Destination_ID', 'Train_ID'], 'integer'],
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
        $query = Passengerticket::find();

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
            'Source_ID' => $this->Source_ID,
            'Destination_ID' => $this->Destination_ID,
            'Train_ID' => $this->Train_ID,
        ]);

        $query->andFilterWhere(['like', 'PNR', $this->PNR])
            ->andFilterWhere(['like', 'Class_type', $this->Class_type])
            ->andFilterWhere(['like', 'Reservation_status', $this->Reservation_status]);

        return $dataProvider;
    }
}
