<?php

namespace frontend\modules\Projects\models;

use Yii;

/**
 * This is the model class for table "bookedticket".
 *
 * @property integer $Train_ID
 * @property string $BookedDate
 * @property string $Category
 *
 * @property Train $train
 */
class Bookedticket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bookedticket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Train_ID', 'BookedDate', 'Category'], 'required'],
            [['Train_ID'], 'integer'],
            [['BookedDate'], 'safe'],
            [['Category'], 'string'],
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
            'BookedDate' => 'Booked Date',
            'Category' => 'Category',
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
