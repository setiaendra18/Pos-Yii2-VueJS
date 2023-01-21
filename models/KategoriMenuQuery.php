<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[KategoriMenu]].
 *
 * @see KategoriMenu
 */
class KategoriMenuQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return KategoriMenu[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return KategoriMenu|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
