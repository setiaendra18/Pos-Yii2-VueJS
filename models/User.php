<?php

namespace app\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

use Yii;

/**
 * This is the model class for table "user_akun".
 *
 * @property string $id_user
 * @property string $nama
 * @property string $alamat
 * @property string $no_tlpn
 * @property string $username
 * @property string $password
 * @property int $level
 * @property string $foto
 * @property string $authKey
 * @property string $accessToken
 *
 * @property Pesanan[] $pesanans
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_akun';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'username', 'password'], 'required'],
            [['level'], 'integer'],
            [['id_user'], 'string', 'max' => 10],
            [['nama'], 'string', 'max' => 20],
            [['alamat'], 'string', 'max' => 25],
            [['no_tlpn'], 'string', 'max' => 12],
            [['username', 'password'], 'string', 'max' => 200],
            [['foto'], 'string', 'max' => 200],
            [['authKey'], 'string', 'max' => 32],
            [['accessToken'], 'string', 'max' => 255],
            [['id_user'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'no_tlpn' => 'No Tlpn',
            'username' => 'Username',
            'password' => 'Password',
            'level' => 'Level',
            'foto' => 'Foto',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesanans()
    {
        return $this->hasMany(Pesanan::className(), ['id_user' => 'id_user']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
          return static::findOne(['access_token' => $token]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    //generator 
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public function setPassword($password)
    {
        $this->password_hash = Security::generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

}
