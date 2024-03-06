<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    // public $id;
    // public $username;
    // public $email;
    // public $password_hash;
    // public $firstname;
    // public $lastname;
    // public $user_role;
    // public $created_at;
    // public $authKey;
    // public $accessToken;
    // private static $users = [
    //     '100' => [
    //         'id' => '100',
    //         'username' => 'admin',
    //         'password' => 'admin',
    //         'authKey' => 'test100key',
    //         'accessToken' => '100-token',
    //     ],
    //     '101' => [
    //         'id' => '101',
    //         'username' => 'demo',
    //         'password' => 'demo',
    //         'authKey' => 'test101key',
    //         'accessToken' => '101-token',
    //     ],
    // ];

    public static function tableName()
    {
        return '{{users}}';
    }    

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password =\Yii::$app->security->generatePasswordHash($password);
    }    

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // If a new password is set or the record is new, hash and set the password
            // if ($this->isNewRecord || $this->isAttributeChanged('password')) {
            //     $this->setPassword($this->password);
            // }
            if ($this->isNewRecord) {
                $this->created_at = date('Y-m-d H:i:s');
            }
            return true;
        }

        return false;
    }

}
