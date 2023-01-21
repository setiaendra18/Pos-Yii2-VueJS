<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PesananDetail]].
 *
 * @see PesananDetail
 */
class PesananDetailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PesananDetail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PesananDetail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
