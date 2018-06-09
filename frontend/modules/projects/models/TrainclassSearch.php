<?php

namespace frontend\modules\projects\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\projects\models\Trainclass;

/**
 * TrainclassSearch represents the model behind the search form about `frontend\modules\projects\models\Trainclass`.
 */
class TrainclassSearch extends Trainclass
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Train_ID', 'Economy_class','First_class', 'Economy_seats', 'First_classSeats'], 'integer'],
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
        $query = Trainclass::find();

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
            'Economy_class' => $this->Economy_class,
            'First_class' => $this->First_class,
            'Economy_seats' => $this->Economy_seats,
            'First_classSeats' => $this->First_classSeats,
        ]);

        return $dataProvider;
    }
}
