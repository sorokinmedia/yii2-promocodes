<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\actions;

use Exception;
use sorokinmedia\promocodes\exceptions\PromoCodeSetUsedError;

/**
 * Class SetUsed
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\actions
 */
class SetUsed extends AbstractAction
{
    /**
     * @return bool
     * @throws Exception
     */
    public function execute(): bool
    {
        try {
            return $this->promo_code_log->setUsed();
        } catch (Exception $exception) {
            throw new PromoCodeSetUsedError($this->promo_code_log->id, $exception->getMessage());
        }
    }
}
