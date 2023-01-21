<?php

namespace app\models; 

use Yii; 

/** 
 * This is the model class for table "pesanan_detail". 
 * 
 * @property int $id
 * @property string $id_pesan
 * @property string $id_menu
 * @property string $jenis_menu
 * @property double $harga
 * @property int $jumlah
 * @property int $status_order
 * 
 * @property Menu $menu
 * @property Pesanan $pesan
 */ 
class PesananDetail extends \yii\db\ActiveRecord
{ 
    /** 
     * {@inheritdoc} 
     */ 
    public static function tableName() 
    { 
        return 'pesanan_detail'; 
    } 

    /** 
     * {@inheritdoc} 
     */ 
    public function rules() 
    { 
        return [
            [['id_pesan'], 'required'],
            [['harga'], 'number'],
            [['jumlah', 'status_order'], 'integer'],
            [['id_pesan', 'id_menu', 'jenis_menu'], 'string', 'max' => 50],
            [['id_menu'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['id_menu' => 'id_menu']],
            [['id_pesan'], 'exist', 'skipOnError' => true, 'targetClass' => Pesanan::className(), 'targetAttribute' => ['id_pesan' => 'id_pesan']],
        ]; 
    } 

    /** 
     * {@inheritdoc} 
     */ 
    public function attributeLabels() 
    { 
        return [ 
            'id' => 'ID',
            'id_pesan' => 'Id Pesan',
            'id_menu' => 'Id Menu',
            'jenis_menu' => 'Jenis Menu',
            'harga' => 'Harga',
            'jumlah' => 'Jumlah',
            'status_order' => 'Status Order',
        ]; 
    } 



    public function fields()
    {
        return ['id','id_pesan', 'id_menu' => function ($model) {
            $menu = Menu::find()->where(['id_menu' => $model->id_menu])->one();
            return $menu->nama;
        },
            'jenis_menu','harga', 'jumlah', 'status_order'];
    }
  
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menu::className(), ['id_menu' => 'id_menu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesan()
    {
        return $this->hasOne(Pesanan::className(), ['id_pesan' => 'id_pesan']);
    }

    /**
     * {@inheritdoc}
     * @return PesananDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PesananDetailQuery(get_called_class());
    }
}
