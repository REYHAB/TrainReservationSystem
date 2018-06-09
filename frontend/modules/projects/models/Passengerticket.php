<?php

namespace frontend\modules\Projects\models;

use Yii;

/**
 * This is the model class for table "passengerticket".
 *
 * @property string $PNR
 * @property integer $Source_ID
 * @property integer $Destination_ID
 * @property string $Class_type
 * @property string $Reservation_status
 * @property integer $Train_ID
 *
 * @property Train $train
 * @property Station $source
 * @property Station $destination
 */
class Passengerticket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'passengerticket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PNR', 'Source_ID', 'Destination_ID', 'Class_type', 'Reservation_status', 'Train_ID'], 'required'],
            [['Source_ID', 'Destination_ID', 'Train_ID'], 'integer'],
            [['PNR', 'Reservation_status'], 'string', 'max' => 20],
            [['Class_type'], 'string', 'max' => 30],
            [['Train_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Train::className(), 'targetAttribute' => ['Train_ID' => 'Train_ID']],
            [['Source_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Station::className(), 'targetAttribute' => ['Source_ID' => 'Station_ID']],
            [['Destination_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Station::className(), 'targetAttribute' => ['Destination_ID' => 'Station_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PNR' => 'Pnr',
            'Source_ID' => 'Source  ID',
            'Destination_ID' => 'Destination  ID',
            'Class_type' => 'Class Type',
            'Reservation_status' => 'Reservation Status',
            'Train_ID' => 'Train  ID',
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
    public function getSource()
    {
        return $this->hasOne(Station::className(), ['Station_ID' => 'Source_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDestination()
    {
        return $this->hasOne(Station::className(), ['Station_ID' => 'Destination_ID']);
    }
}
