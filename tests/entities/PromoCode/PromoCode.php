<?php
namespace sorokinmedia\promocodes\tests\entities\PromoCode;

use sorokinmedia\promocodes\entities\PromoCode\AbstractPromoCode;
use sorokinmedia\promocodes\tests\entities\User\RelationClassTrait;
use yii\web\IdentityInterface;

/**
 * Class PromoCode
 * @package sorokinmedia\promocodes\tests\entities\PromoCode
 */
class PromoCode extends AbstractPromoCode
{
    use RelationClassTrait;

    public function checkCode(IdentityInterface $user) : bool
    {
        return true;
    }

    public function afterRechargeBeneficiary(IdentityInterface $user) : bool
    {
        return true;
    }

    public function afterRechargePayment(IdentityInterface $user) : int
    {
        return 0;
    }
}