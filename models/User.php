<?php

namespace app\models;

use app\models\Users;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $isAdmin;


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        $model = Users::findOne(['id' => $id]);
        if (!$model) {
            return null;
        }
        return self::transformUsersModel($model);
    }

    private static function transformUsersModel(Users $model)
    {
        return new static([
            'id'       => $model->id,
            'username' => $model->username,
            'password' => $model->password,
            'isAdmin'  => $model->isAdmin,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $model = Users::findOne(['accessToken' => $token]);
        if (!$model) {
            return null;
        }
        return self::transformUsersModel($model);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $model = Users::findOne(['username' => $username]);
        if (!$model) {
            return null;
        }
        return self::transformUsersModel($model);
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
    }

    public function isAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
