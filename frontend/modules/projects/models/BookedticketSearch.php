<?php

namespace frontend\modules\projects\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\projects\models\Bookedticket;

/**
 * BookedticketSearch represents the model behind the search form about `frontend\modules\projects\models\Bookedticket`.
 */
class BookedticketSearch extends Bookedticket
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Train_ID'], 'integer'],
            [['BookedDate', 'Category'], 'safe'],
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
        $query = Bookedticket::find();

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
            'BookedDate' => $this->BookedDate,
        ]);

        $query->andFilterWhere(['like', 'Category', $this->Category]);

        return $dataProvider;
    }
}
