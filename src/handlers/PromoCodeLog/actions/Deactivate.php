<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\actions;

use Exception;
use sorokinmedia\promocodes\exceptions\PromoCodeDeactivationError;

/**
 * Class Deactivate
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\actions
 */
class Deactivate extends AbstractActionWithOperation
{
    /**
     * @return bool
     * @throws Exception
     */
    public function execute(): bool
    {
        try {
            return $this->promo_code_log->setDeactivated($this->operation_id);
        } catch (Exception $exception) {
            throw new PromoCodeDeactivationError($this->promo_code_log->id, $exception->getMessage());
        }
    }
}
