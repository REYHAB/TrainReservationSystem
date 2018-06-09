<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $FullName;
    public $username;
    public $email;
    public $password;
    public $Gender;
    public $Age;
    public $MobileNumber;
    public $ConfirmPassword;
    public $Nationality;
    public $SecurityQuestion;
    public $SecurityAnswer;
    public $City;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['FullName', 'trim'],
            ['FullName', 'required'],
            ['FullName','match', 'pattern' => '/^[a-zA-Z_-]/','message' => 'Enter Characters Only'],
            ['FullName', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['FullName', 'string', 'min' => 2, 'max' => 255],

            ['username', 'trim'],
            ['username', 'required'],
            ['username','match', 'pattern' => '/^[a-zA-Z_-]/','message' => 'Enter Characters Only'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],


            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['ConfirmPassword','compare','compareAttribute'=>'password'],


            ['Gender', 'trim'],
            ['Gender', 'required'],
            ['Gender', 'string'],

            ['Age', 'trim'],
            ['Age', 'required'],
            ['Age', 'string', 'min' => 1, 'max' => 120],

            ['MobileNumber', 'trim'],
            ['MobileNumber', 'required'],
            ['MobileNumber', 'match', 'pattern' => '/((\+[0-9]{6})|0)[-]?[0-9]{7}/'],
            ['MobileNumber', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This MobileNumber has already been taken.'],
            ['MobileNumber', 'string', 'min' => 10, 'max' => 12],

            ['City', 'trim'],
            ['City', 'required'],
            ['City','match', 'pattern' => '/^[a-zA-Z_-]/','message' => 'Enter Characters Only'],
            ['City', 'string'],

            ['Nationality', 'trim'],
            ['Nationality', 'required'],
            ['Nationality', 'string'],






        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->FullName = $this->FullName;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->Age= $this->Age;
        $user->MobileNumber = $this->MobileNumber;
        $user->City =$this->City;

        $user->Nationality =$this->Nationality;
        $user->Gender =$this->Gender;


        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}
