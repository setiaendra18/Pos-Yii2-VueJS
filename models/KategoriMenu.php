<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kategori_menu".
 *
 * @property string $id_ktmenu
 * @property string $nama_kategori
 *
 * @property Menu[] $menus
 */
class KategoriMenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kategori_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ktmenu', 'nama_kategori'], 'required'],
            [['id_ktmenu'], 'string', 'max' => 10],
            [['nama_kategori'], 'string', 'max' => 15],
            [['id_ktmenu'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ktmenu' => 'Id Ktmenu',
            'nama_kategori' => 'Nama Kategori',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['id_ktmenu' => 'id_ktmenu']);
    }

  

    /**
     * {@inheritdoc}
     * @return KategoriMenuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new KategoriMenuQuery(get_called_class());
    }
}
