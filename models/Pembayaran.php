<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pembayaran".
 *
 * @property string $no_nota
 * @property string $id_pesan
 * @property string $tanggal
 * @property double $total_bayar
 * @property int $status_bayar
 *
 * @property Pesanan $pesan
 */
class Pembayaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembayaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_nota', 'id_pesan'], 'required'],
            [['tanggal'], 'safe'],
            [['total_bayar'], 'number'],
            [['status_bayar'], 'integer'],
            [['no_nota'], 'string', 'max' => 100],
            [['id_pesan'], 'string', 'max' => 10],
            [['no_nota'], 'unique'],
            [['id_pesan'], 'exist', 'skipOnError' => true, 'targetClass' => Pesanan::className(), 'targetAttribute' => ['id_pesan' => 'id_pesan']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'no_nota' => 'No Nota',
            'id_pesan' => 'Id Pesan',
            'tanggal' => 'Tanggal',
            'total_bayar' => 'Total Bayar',
            'status_bayar' => 'Status Bayar',
        ];
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
     * @return PembayaranQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PembayaranQuery(get_called_class());
    }
}
