<?php
namespace sorokinmedia\promocodes\tests\entities\UserAccessToken;

use sorokinmedia\user\entities\UserAccessToken\AbstractUserAccessToken;
use sorokinmedia\promocodes\tests\entities\User\RelationClassTrait;
use yii\db\ActiveQuery;

/**
 * Class UserAccessToken
 * @package sorokinmedia\promocodes\tests\entities\UserAccessToken
 */
class UserAccessToken extends AbstractUserAccessToken
{
    use RelationClassTrait;

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() : ActiveQuery
    {
        return $this->hasOne($this->__userClass, ['id' => 'user_id']);
    }
}