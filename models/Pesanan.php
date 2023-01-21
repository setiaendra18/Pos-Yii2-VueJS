<?php

namespace app\models; 

use Yii; 

/** 
 * This is the model class for table "pesanan". 
 * 
 * @property string $id_pesan
 * @property string $tanggal
 * @property string $id_ktpesan
 * @property string $id_meja
 * @property string $id_user
 * @property string $keterangan
 * @property int $status_pesan
 * 
 * @property Pembayaran[] $pembayarans
 * @property KategoriPesan $ktpesan
 * @property Meja $meja
 * @property UserAkun $user
 * @property PesananDetail[] $pesananDetails
 */ 
class Pesanan extends \yii\db\ActiveRecord
{ 
    /** 
     * {@inheritdoc} 
     */ 
    public static function tableName() 
    { 
        return 'pesanan'; 
    } 

    /** 
     * {@inheritdoc} 
     */ 
    public function rules() 
    { 
        return [
            [['id_pesan', 'tanggal', 'id_ktpesan'], 'required'],
            [['tanggal'], 'safe'],
            [['keterangan'], 'string'],
            [['status_pesan'], 'integer'],
            [['id_pesan'], 'string', 'max' => 50],
            [['id_ktpesan', 'id_meja', 'id_user'], 'string', 'max' => 10],
            [['id_pesan'], 'unique'],
            [['id_ktpesan'], 'exist', 'skipOnError' => true, 'targetClass' => KategoriPesan::className(), 'targetAttribute' => ['id_ktpesan' => 'id_ktpesan']],
            [['id_meja'], 'exist', 'skipOnError' => true, 'targetClass' => Meja::className(), 'targetAttribute' => ['id_meja' => 'id_meja']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => UserAkun::className(), 'targetAttribute' => ['id_user' => 'id_user']],
        ]; 
    } 

    /** 
     * {@inheritdoc} 
     */ 
    public function attributeLabels() 
    { 
        return [ 
            'id_pesan' => 'Id Pesan',
            'tanggal' => 'Tanggal',
            'id_ktpesan' => 'Id Ktpesan',
            'id_meja' => 'Id Meja',
            'id_user' => 'Id User',
            'keterangan' => 'Keterangan',
            'status_pesan' => 'Status Pesan',
        ]; 
    } 

    public function fields()
    {
        return ['id_pesan','tanggal','id_ktpesan' => function ($model)
        {
            $KategoriPesan=KategoriPesan::find()->where(['id_ktpesan'=>$model->id_ktpesan])->one();
                    return $KategoriPesan->nama_kategori;
        },
        'id_meja','id_user'=> function ($model)
        {
            $nama_user=UserAkun::find()->where(['id_user'=>$model->id_user])->one();
                    return $nama_user->nama;
        },'keterangan','status_pesan'];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPembayarans()
    {
        return $this->hasMany(Pembayaran::className(), ['id_pesan' => 'id_pesan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKtpesan()
    {
        return $this->hasOne(KategoriPesan::className(), ['id_ktpesan' => 'id_ktpesan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeja()
    {
        return $this->hasOne(Meja::className(), ['id_meja' => 'id_meja']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserAkun::className(), ['id_user' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesananDetails()
    {
        return $this->hasMany(PesananDetail::className(), ['id_pesan' => 'id_pesan']);
    }

    /**
     * {@inheritdoc}
     * @return PesananQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PesananQuery(get_called_class());
    }
}
