<?php

namespace frontend\modules\rbac\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $ADDEDBY
 * @property string $EMPLOYEENAME
 * @property string $TITLE
 * @property string $OFFICEEXTENSION
 * @property string $HOMEPHONE
 * @property string $CELLPHONE
 * @property string $OTHEREMAIL
 * @property integer $ACTIVE
 * @property string $USERNAME
 * @property string $PASSWORD
 * @property integer $PROFILEID
 * @property integer $ACTIVATED
 * @property integer $LOCKED
 * @property integer $APPROVED
 * @property string $APPROVEDBY
 * @property integer $DAYSTOLOCKUSER
 * @property string $DATEADDED
 * @property string $LASTUPDATED
 * @property string $CLIENTID
 * @property integer $DELETED
 * @property string $DELETIONREMARKS
 * @property integer $RESET
 * @property string $RESETMAKERREMARKS
 * @property string $BRANCH
 * @property string $LASTLOGOUT
 * @property string $PROFILENAME
 * @property string $LOGGEDIN
 * @property string $IPADDRESS
 * @property integer $DELETEAPPROVED
 * @property string $DELETEAPPROVEDBY
 * @property integer $LOGINTRIAL
 * @property string $MIDDLENAME
 * @property string $LASTNAME
 * @property string $CLIENTIPADDRESS
 * @property string $MAKERLOGOFF
 * @property string $CHECKERLOGOFF
 * @property string $MAKERLOGOFFREMARK
 * @property string $CHECKERLOGOFFREMARK
 * @property string $MAKERLOGOFFDATE
 * @property string $CHECKERLOGOFFDATE
 * @property string $LOGOFF
 * @property string $ROLE
 * @property string $IMAGEPATH
 * @property integer $confirmed_at
 * @property string $unconfirmed_email
 * @property integer $blocked_at
 * @property string $registration_ip
 * @property integer $flags
 */
class Usernew extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'status', 'created_at', 'updated_at', 'ACTIVE', 'PROFILEID', 'ACTIVATED', 'LOCKED', 'APPROVED', 'DAYSTOLOCKUSER', 'DELETED', 'RESET', 'DELETEAPPROVED'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [[ 'FullName', 'IMAGEPATH'], 'string', 'max' => 100],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ADDEDBY' => 'Addedby',
            'FullName' => 'FullName',
            'TITLE' => 'Title',
            'OFFICEEXTENSION' => 'Officeextension',
            'HOMEPHONE' => 'Homephone',
            'CELLPHONE' => 'Cellphone',
            'OTHEREMAIL' => 'Otheremail',
            'ACTIVE' => 'Active',
            'USERNAME' => 'Username',
            'PASSWORD' => 'Password',
            'PROFILEID' => 'Profileid',
            'ACTIVATED' => 'Activated',
            'LOCKED' => 'Locked',
            'APPROVED' => 'Approved',
            'APPROVEDBY' => 'Approvedby',
            'DAYSTOLOCKUSER' => 'Daystolockuser',
            'DATEADDED' => 'Dateadded',
            'LASTUPDATED' => 'Lastupdated',
            'CLIENTID' => 'Clientid',
            'DELETED' => 'Deleted',
            'DELETIONREMARKS' => 'Deletionremarks',
            'RESET' => 'Reset',
            'RESETMAKERREMARKS' => 'Resetmakerremarks',
            'BRANCH' => 'Branch',
            'LASTLOGOUT' => 'Lastlogout',
            'PROFILENAME' => 'Profilename',
            'LOGGEDIN' => 'Loggedin',
            'IPADDRESS' => 'Ipaddress',
            'DELETEAPPROVED' => 'Deleteapproved',
            'DELETEAPPROVEDBY' => 'Deleteapprovedby',
            'LOGINTRIAL' => 'Logintrial',
            'MIDDLENAME' => 'Middlename',
            'LASTNAME' => 'Lastname',
            'CLIENTIPADDRESS' => 'Clientipaddress',
            'MAKERLOGOFF' => 'Makerlogoff',
            'CHECKERLOGOFF' => 'Checkerlogoff',
            'MAKERLOGOFFREMARK' => 'Makerlogoffremark',
            'CHECKERLOGOFFREMARK' => 'Checkerlogoffremark',
            'MAKERLOGOFFDATE' => 'Makerlogoffdate',
            'CHECKERLOGOFFDATE' => 'Checkerlogoffdate',
            'LOGOFF' => 'Logoff',
            'ROLE' => 'Role',
            'IMAGEPATH' => 'Imagepath',
            'confirmed_at' => 'Confirmed At',
            'unconfirmed_email' => 'Unconfirmed Email',
            'blocked_at' => 'Blocked At',
            'registration_ip' => 'Registration Ip',
            'flags' => 'Flags',
        ];
    }
}
