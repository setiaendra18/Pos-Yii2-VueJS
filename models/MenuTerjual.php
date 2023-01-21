<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu_terjual".
 *
 * @property string $id_pesan
 * @property string $tanggal
 * @property string $nama
 * @property string $id_menu
 * @property string $jumlah
 */
class MenuTerjual extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_terjual';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pesan', 'tanggal', 'nama'], 'required'],
            [['tanggal'], 'safe'],
            [['jumlah'], 'number'],
            [['id_pesan', 'nama', 'id_menu'], 'string', 'max' => 50],
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
            'nama' => 'Nama',
            'id_menu' => 'Id Menu',
            'jumlah' => 'Jumlah',
        ];
    }
}
