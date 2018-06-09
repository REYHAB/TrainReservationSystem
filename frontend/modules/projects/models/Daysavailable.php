<?php

namespace frontend\modules\Projects\models;

use Yii;

/**
 * This is the model class for table "daysavailable".
 *
 * @property integer $Train_ID
 * @property string $Available_days
 *
 * @property Train $train
 */
class Daysavailable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'daysavailable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Train_ID', 'Available_days'], 'required'],
            [['Train_ID'], 'integer'],
            [['Available_days'], 'string', 'max' => 40],
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
            'Available_days' => 'Available Days',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrain()
    {
        return $this->hasOne(Train::className(), ['Train_ID' => 'Train_ID']);
    }

    public function getDays($id)
    {
        $days=$this->find()->where(['Train_ID'=>$id])->one();
        $noofdays=$days['Available_days'];
        return $noofdays;
    }


    function getDay(){
        $dowMap = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        $dow_numeric = date('w');
        return $dowMap[$dow_numeric];
    }


}
