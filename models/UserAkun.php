<?php

namespace app\models;
use yii\web\IdentityInterface;
use Yii;

/**
 * This is the model class for table "user_akun".
 *
 * @property string $id_user
 * @property string $nama
 * @property string $alamat
 * @property int $no_tlpn
 * @property string $username
 * @property string $password
 * @property int $level
 * @property string $foto
 *
 * @property Pesanan[] $pesanans
 */
class UserAkun extends \yii\db\ActiveRecord 
{

    const SCENARIO_LOGIN = 'login';
    const SCENARIO_CREATE = 'create';
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
         
        ];
    }
    public function fields()
    {
        return ['id_user','nama','alamat','no_tlpn','username','password','level'];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesanans()
    {
        return $this->hasMany(Pesanan::className(), ['id_user' => 'id_user']);
    }

    /**
     * {@inheritdoc}
     * @return UserAkunQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserAkunQuery(get_called_class());
    }
}
