<?php

namespace frontend\modules\Projects\models;

use Yii;

/**
 * This is the model class for table "train".
 *
 * @property integer $Train_ID
 * @property string $Train_name
 * @property string $Train_type
 * @property string $Source_stn
 * @property string $Destination_stn
 * @property integer $Source_ID
 * @property integer $Destinaton_ID
 *
 * @property Daysavailable $daysavailable
 * @property Passenger $passenger
 * @property Passengerticket[] $passengertickets
 * @property Route[] $routes
 * @property Routehasstation[] $routehasstations
 * @property Station $source
 * @property Station $destinaton
 * @property Trainclass $trainclass
 * @property Trainstatus[] $trainstatuses
 */
class Train extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'train';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Train_ID', 'Train_name', 'Train_type', 'Source_stn', 'Destination_stn', 'Arrival_time', 'Departure_time','Economy_classfare','First_classfare'], 'required'],
            [['Train_ID', 'Economy_classfare','First_classfare'], 'integer'],
            [['Arrival_time', 'Departure_time'], 'safe'],
            [['Train_name', 'Train_type', 'Source_stn', 'Destination_stn'], 'string', 'max' => 30],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Train_ID' => 'Train  ID',
            'Train_name' => 'Train Name',
            'Train_type' => 'Train Type',
            'Source_stn' => 'Source Stn',
            'Destination_stn' => 'Destination Stn',

            'First_classfare' => 'First class fare',
            'Economy_classfare' => 'Economy class fare',

            'Arrival_time' => 'Arrival Time',
            'Departure_time' => 'Departure Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDaysavailable()
    {
        return $this->hasOne(daysavailable::className(), ['Train_ID' => 'Train_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPassenger()
    {
        return $this->hasOne(Passenger::className(), ['Train_ID' => 'Train_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPassengertickets()
    {
        return $this->hasMany(Passengerticket::className(), ['Train_ID' => 'Train_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoutes()
    {
        return $this->hasMany(Route::className(), ['Train_ID' => 'Train_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource()
    {
        return $this->hasOne(Station::className(), ['Station_ID' => 'Source_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDestinaton()
    {
        return $this->hasOne(Station::className(), ['Station_ID' => 'Destinaton_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainclass()
    {
        return $this->hasOne(trainclass::className(), ['Train_ID' => 'Train_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainstatuses()
    {
        return $this->hasMany(Trainstatus::className(), ['Train_ID' => 'Train_ID']);
    }

}
