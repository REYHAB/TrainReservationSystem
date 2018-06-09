<?php

namespace frontend\modules\projects\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\projects\models\Passenger;

/**
 * PassengerSearch represents the model behind the search form about `frontend\modules\projects\models\Passenger`.
 */
class PassengerSearch extends Passenger
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Ticket_ID', 'Age', 'Train_no'], 'integer'],
            [['Pname', 'Paddress', 'BookedDate', 'Pcategory', 'Pstatus', 'Pgender'], 'safe'],
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
        $query = Passenger::find();

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
            'Ticket_ID' => $this->Ticket_ID,
            'Age' => $this->Age,
            'BookedDate' => $this->BookedDate,
            'Train_no' => $this->Train_no,
        ]);

        $query->andFilterWhere(['like', 'Pname', $this->Pname])
            ->andFilterWhere(['like', 'Paddress', $this->Paddress])
            ->andFilterWhere(['like', 'Pcategory', $this->Pcategory])
            ->andFilterWhere(['like', 'Pstatus', $this->Pstatus])
            ->andFilterWhere(['like', 'Pgender', $this->Pgender]);

        return $dataProvider;
    }
}
