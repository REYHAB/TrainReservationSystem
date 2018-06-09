<?php

namespace frontend\modules\projects\models;
use Yii;

/**
 * This is the model class for table "route".
 *
 * @property integer $Train_ID
 * @property integer $Station_ID
 * @property string $Arrival_time
 * @property string $Departure_time
 * @property integer $Source_distance
 *
 * @property Train $train
 * @property Station $station
 */
class Route extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'route';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Train_ID', 'Station_ID', 'Arrival_time', 'Departure_time', 'Source_distance'], 'required'],
            [['Train_ID', 'Station_ID', 'Source_distance'], 'integer'],
            [['Arrival_time', 'Departure_time'], 'safe'],
            [['Train_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Train::className(), 'targetAttribute' => ['Train_ID' => 'Train_ID']],
            [['Station_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Station::className(), 'targetAttribute' => ['Station_ID' => 'Station_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Train_ID' => 'Train  ID',
            'Station_ID' => 'Station  ID',
            'Arrival_time' => 'Arrival Time',
            'Departure_time' => 'Departure Time',
            'Source_distance' => 'Source Distance',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrain()
    {
        return $this->hasOne(Train::className(), ['Train_ID' => 'Train_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStation()
    {
        return $this->hasOne(Station::className(), ['Station_ID' => 'Station_ID']);
    }
}
