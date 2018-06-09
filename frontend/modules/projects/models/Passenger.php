<?php

namespace frontend\modules\Projects\models;

use Yii;

/**
 * This is the model class for table "passenger".
 *
 * @property integer $Ticket_ID
 * @property string $Pname
 * @property string $Paddress
 * @property integer $Age
 * @property string $BookedDate
 * @property integer $Train_ID
 * @property string $Pcategory
 * @property string $Pstatus
 * @property string $Pgender
 *
 * @property Cancel $cancel
 * @property Train $trainNo
 */
class Passenger extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'passenger';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Ticket_ID', 'Pname', 'Paddress', 'Age', 'BookedDate', 'Train_ID', 'Pcategory', 'Pstatus', 'Pgender','MPESAReferenceNumber'], 'required'],
            [['Ticket_ID', 'Age', 'Train_ID'], 'integer'],
            [['BookedDate'], 'safe'],
            [['Pcategory', 'Pstatus', 'Pgender','MPESAReferenceNumber'], 'string'],
            [['Pname', 'Paddress'], 'string', 'max' => 20],
            [['Train_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Train::className(), 'targetAttribute' => ['Train_ID' => 'Train_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Ticket_ID' => 'Ticket  ID',
            'Pname' => 'Pname',
            'Paddress' => 'Paddress',
            'Age' => 'Age',
            'BookedDate' => 'Booked Date',
            'Train_ID' => 'Train ID',
            'Pcategory' => 'Pcategory',
            'Pstatus' => 'Pstatus',
            'Pgender' => 'Pgender',
            'MPESAReferenceNumber'=>'MPESAReferenceNumber',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCancel()
    {
        return $this->hasOne(Cancel::className(), ['TicketID' => 'Ticket_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainNo()
    {
        return $this->hasOne(Train::className(), ['Train_ID' => 'Train_no']);
    }





}
