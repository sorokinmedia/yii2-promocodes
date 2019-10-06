<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\actions;

use Exception;
use sorokinmedia\promocodes\exceptions\PromoCodeActivationError;

/**
 * Class ActivePercentageDiscount
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\actions
 */
class ActivePercentageDiscount extends AbstractActionWithOperation
{
    /**
     * @return bool
     * @throws Exception
     */
    public function execute(): bool
    {
        try {
            return $this->promo_code_log->setActivated($this->operation_id);
        } catch (Exception $exception) {
            throw new PromoCodeActivationError($this->promo_code_log->id, $exception->getMessage());
        }
    }
}
