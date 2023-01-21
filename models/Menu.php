<?php

namespace app\models;

use Yii;

/** 
 * This is the model class for table "menu". 
 * 
 * @property string $id_menu
 * @property string $nama
 * @property string $id_ktmenu
 * @property string $satuan
 * @property double $harga
 * @property int $stok
 * @property string $deskripsi
 * @property resource $foto
 * 
 * @property KategoriMenu $ktmenu
 * @property PesananDetail[] $pesananDetails
 */ 
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $foto;

    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() 
    { 
        return [
            [['id_menu', 'nama', 'satuan', 'harga', 'stok'], 'required'],
            [['harga'], 'number'],
            [['stok'], 'integer'],
            [['deskripsi'], 'string'],
            [['id_menu', 'id_ktmenu'], 'string', 'max' => 10],
            [['id_menu', 'nama'], 'string', 'max' => 50],
            [['id_ktmenu'], 'string', 'max' => 10],
            [['satuan'], 'string', 'max' => 8],
            [['id_menu'], 'unique'],
            [['id_ktmenu'], 'exist', 'skipOnError' => true, 'targetClass' => KategoriMenu::className(), 'targetAttribute' => ['id_ktmenu' => 'id_ktmenu']],
        ]; 
    } 

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_menu' => 'Id Menu',
            'nama' => 'Nama',
            'id_ktmenu' => 'Id Ktmenu',
            'satuan' => 'Satuan',
            'harga' => 'Harga',
            'stok' => 'Stok',
            'deskripsi' => 'Deskripsi',
            'foto' => 'Foto',
        ];
    }
    public function fields()
    {
        return ['id_menu', 'nama','id_ktmenu' => function ($model)
        {
            $kategori_menu=KategoriMenu::find()->where(['id_ktmenu'=>$model->id_ktmenu])->one();
                    return $kategori_menu->nama_kategori;
        },
        'satuan','harga','stok','deskripsi'];
    }
    public function extraFields() {
        return ['id_ktmenu'];
    }
    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKtmenu()
    {
        return $this->hasOne(KategoriMenu::className(), ['id_ktmenu' => 'id_ktmenu']);
    }

    /**
     * {@inheritdoc}
     * @return MenuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MenuQuery(get_called_class());
    }
}
