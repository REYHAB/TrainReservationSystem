<?php

namespace frontend\modules\Projects\models;

use Yii;

/**
 * This is the model class for table "cancel".
 *
 * @property integer $TicketID
 * @property string $Dateofbooked
 *
 * @property Passenger $ticket
 */
class Cancel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cancel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TicketID', 'Dateofbooked'], 'required'],
            [['TicketID'], 'integer'],
            [['Dateofbooked'], 'safe'],
            [['TicketID'], 'exist', 'skipOnError' => true, 'targetClass' => Passenger::className(), 'targetAttribute' => ['TicketID' => 'Ticket_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TicketID' => 'Ticket ID',
            'Dateofbooked' => 'Dateofbooked',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Passenger::className(), ['Ticket_ID' => 'TicketID']);
    }
}
