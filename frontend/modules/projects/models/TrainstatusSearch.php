<?php

namespace frontend\modules\projects\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\projects\models\Trainstatus;

/**
 * TrainstatusSearch represents the model behind the search form about `frontend\modules\projects\models\Trainstatus`.
 */
class TrainstatusSearch extends Trainstatus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Train_date', 'BookedDate'], 'safe'],
            [['Ac_seatnumber', 'Gen_seatnumber', 'Train_num', 'BookedAcseats', 'BookedGenseats'], 'integer'],
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
        $query = Trainstatus::find();

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
            'Train_date' => $this->Train_date,
            'Ac_seatnumber' => $this->Ac_seatnumber,
            'Gen_seatnumber' => $this->Gen_seatnumber,
            'BookedDate' => $this->BookedDate,
            'Train_num' => $this->Train_num,
            'BookedAcseats' => $this->BookedAcseats,
            'BookedGenseats' => $this->BookedGenseats,
        ]);

        return $dataProvider;
    }
}
