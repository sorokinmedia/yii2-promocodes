<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\actions;

use Exception;
use sorokinmedia\promocodes\exceptions\PromoCodeActivationError;
use sorokinmedia\promocodes\handlers\PromoCode\PromoCodeHandler;

/**
 * Class Activate
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\actions
 */
class Activate extends AbstractAction
{
    /**
     * @return bool
     * @throws Exception
     */
    public function execute(): bool
    {
        try {
            $operation_id = (new PromoCodeHandler($this->promo_code_log->promoCode))->activate($this->promo_code_log->user);
            return $this->promo_code_log->setActivated($operation_id);
        } catch (Exception $exception) {
            throw new PromoCodeActivationError($this->promo_code_log->id, $exception->getMessage());
        }
    }
}
