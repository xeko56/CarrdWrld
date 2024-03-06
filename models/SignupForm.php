<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $firstname;
    public $lastname;

    public function rules()
    {
        return [
            [['username', 'email', 'password', 'firstname', 'lastname'], 'required'],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This username has already been taken.'],
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->firstname = $this->firstname;
            $user->lastname = $this->lastname;
            $user->setPassword($this->password);

            if ($user->save()) {
                return $user;
            } else {
                \Yii::debug($user->errors);
            }
        }
        print_r($this->errors);
        return null;
    }
}