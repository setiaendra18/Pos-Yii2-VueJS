<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Pesanan]].
 *
 * @see Pesanan
 */
class PesananQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Pesanan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Pesanan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
