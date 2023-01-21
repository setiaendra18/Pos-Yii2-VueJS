<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "meja".
 *
 * @property string $id_meja
 * @property int $nomor_meja
 *
 * @property Pesanan[] $pesanans
 */
class Meja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_meja', 'nomor_meja'], 'required'],
            [['nomor_meja'], 'integer'],
            [['id_meja'], 'string', 'max' => 10],
            [['id_meja'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_meja' => 'Id Meja',
            'nomor_meja' => 'Nomor Meja',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesanans()
    {
        return $this->hasMany(Pesanan::className(), ['id_meja' => 'id_meja']);
    }

    /**
     * {@inheritdoc}
     * @return MejaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MejaQuery(get_called_class());
    }
}
