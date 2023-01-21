<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kategori_pesan".
 *
 * @property string $id_ktpesan
 * @property string $nama_kategori
 *
 * @property Pesanan[] $pesanans
 */
class KategoriPesan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kategori_pesan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ktpesan', 'nama_kategori'], 'required'],
            [['id_ktpesan', 'nama_kategori'], 'string', 'max' => 50],
            [['id_ktpesan'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ktpesan' => 'Id Ktpesan',
            'nama_kategori' => 'Nama Kategori',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesanans()
    {
        return $this->hasMany(Pesanan::className(), ['id_ktpesan' => 'id_ktpesan']);
    }

    /**
     * {@inheritdoc}
     * @return KategoriPesanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new KategoriPesanQuery(get_called_class());
    }
}
