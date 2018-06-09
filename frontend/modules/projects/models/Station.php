<?php

namespace frontend\modules\Projects\models;

use Yii;

/**
 * This is the model class for table "station".
 *
 * @property integer $Station_ID
 * @property string $Station_name
 *
 * @property Passengerticket[] $passengertickets
 * @property Passengerticket[] $passengertickets0
 * @property Route[] $routes
 * @property Routehasstation[] $routehasstations
 * @property Train[] $trains
 * @property Train[] $trains0
 */
class Station extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'station';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Station_ID', 'Station_name'], 'required'],
            [['Station_ID'], 'integer'],
            [['Station_name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Station_ID' => 'Station  ID',
            'Station_name' => 'Station Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPassengertickets()
    {
        return $this->hasMany(Passengerticket::className(), ['Source_ID' => 'Station_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPassengertickets0()
    {
        return $this->hasMany(Passengerticket::className(), ['Destination_ID' => 'Station_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoutes()
    {
        return $this->hasMany(Route::className(), ['Station_ID' => 'Station_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoutehasstations()
    {
        return $this->hasMany(Routehasstation::className(), ['Station_ID' => 'Station_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrains()
    {
        return $this->hasMany(Train::className(), ['Source_ID' => 'Station_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrains0()
    {
        return $this->hasMany(Train::className(), ['Destinaton_ID' => 'Station_ID']);
    }
}
