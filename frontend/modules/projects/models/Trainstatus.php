<?php

namespace frontend\modules\projects\models;

use Yii;

/**
 * This is the model class for table "trainstatus".
 *

 * @property string $Available_days
 * @property integer $Economy_seatnumber
 * @property integer $First_seatnumber
 * @property string $BookedDate
 * @property integer $Train_ID
 * @property integer $BookedEcoseats
 * @property integer $BookedFirstseats
 */
class Trainstatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trainstatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Available_days','Economy_seatnumber', 'First_seatnumber', 'BookedDate', 'Train_ID', 'BookedEcoseats', 'BookedFirstseats'], 'required'],
            [[ 'BookedDate'], 'safe'],

            [['First_seatnumber', 'Economy_seatnumber', 'Train_ID', 'BookedEcoseats', 'BookedFirstseats'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'Available_days'=>'Available days',
            'Economy_seatnumber' => 'Economy seatnumber',
            'First_seatnumber' => 'First_seatnumber',
            'BookedDate' => 'Booked Date',
            'Train_ID' => 'Train ID',
            'BookedFirstseats' => 'Booked Firstseats',
            'BookedEcoseats' => 'Booked Ecoseats',
        ];
    }
    //check availability of seats and date;
    public function checkAvailability($trainid,$date,$category){


        $check=$this->find()->where(['Train_ID'=>$trainid])->one();
        if($check){
            $fclassno=$check['First_seatnumber'];
            $ecoclassno=$check['Economy_seatnumber'];
            $fbookedno=$check['BookedFirstseats'];
            $ecobookedno=$check['BookedEcoseats'];

            if($category=='Economy'){
                if($ecobookedno==$ecoclassno){

                    return 'Economy Class Seats Not Available';

                }

                else{

                    return 1;
                }
            }
            else{

                if($fbookedno==$fclassno){

                    return 'First Class Seats Not Available';
                }

                else{

                    return 1;
                }

            }

        }


    }

}
