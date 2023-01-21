<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Meja]].
 *
 * @see Meja
 */
class MejaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Meja[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Meja|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
