<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UserAkun]].
 *
 * @see UserAkun
 */
class UserAkunQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserAkun[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserAkun|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
