<?php

namespace frontend\modules\rbac\models;

use Yii;

/**
 * This is the model class for table "ebr_users".
 *
 * @property integer $id_user
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property FobUserGoals[] $fobUserGoals
 * @property FobUserTasks[] $fobUserTasks
 */
class Users extends \yii\db\ActiveRecord
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
            [['auth_key', 'password_hash', 'status', 'created_at', 'updated_at'], 'required'],
            [['username', 'password', 'first_name','middle_name', 'last_name', 'email'], 'string', 'max' => 45],
            [['auth_key', 'password_hash', 'password_reset_token', 'status', 'created_at', 'updated_at'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'username' => 'Username',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'first_name' => 'First Name',
        	'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFobUserGoals()
    {
        return $this->hasMany(FobUserGoals::className(), ['id_user' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFobUserTasks()
    {
        return $this->hasMany(FobUserTasks::className(), ['id_user' => 'id_user']);
    }
    
    public function getGoals(){
    	return $this->hasMany(Goals::className(),['gls_id' => 'gls_id'])
    	->viaTable('fob_user_goals',['id_user' => 'id_user']);
    }
}
