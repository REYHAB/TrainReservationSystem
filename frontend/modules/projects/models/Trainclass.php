<?php

namespace frontend\modules\projects\models;

use Yii;

/**
 * This is the model class for table "trainclass".
 *
 * @property integer $Train_ID
 * @property integer $Economy_class
 * @property integer $Economy_seats
 * @property integer $First_classSeats
 *
 * @property Train $train
 */
class Trainclass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trainclass';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Train_ID', 'Economy_class', 'First_class','Economy_seats', 'First_classSeats','BookedEconomyseats','BookedFirstseats'], 'required'],
            [['Train_ID', 'Economy_class', 'Economy_seats', 'First_classSeats'], 'integer'],
            [['Train_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Train::className(), 'targetAttribute' => ['Train_ID' => 'Train_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Train_ID' => 'Train  ID',
            'Economy_class' => 'Economy Class',
            'First_class' => 'First Class',
            'Economy_seats' => 'Economy Seats',
            'First_classSeats' => 'First Class Seats',
            'BookedEconomyseats' => ' Booked Economy Seats',
            'BookedFirstseats' => 'BookedFirstclassSeats',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrain()
    {
        return $this->hasOne(Train::className(), ['Train_ID' => 'Train_ID']);
    }
}
