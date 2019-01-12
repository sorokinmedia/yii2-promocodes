<?php
namespace sorokinmedia\promocodes\handlers\PromoCode\actions;

use yii\db\Exception;

/**
 * Class Activate
 * @package sorokinmedia\promocodes\handlers\PromoCode\actions
 */
class Activate extends AbstractAction
{
    /**
     * @return bool
     * @throws Exception
     */
    public function execute() : bool
    {
        //todo: refactor
        /*if ($this->user->userAffiliate === null && $this->promoCode->user_id) {
            $user_affiliate = UserAffiliate::create($this->user, $this->promoCode->user);
            if (!$user_affiliate instanceof UserAffiliate){
                throw new Exception(\Yii::t('app', 'Ошибка при добавлении аффилиатной связи'));
            }
        }
        PaymentPromoCode::addOperationPromoCode($this->user, $this->promoCode);*/
        return true;
    }
}