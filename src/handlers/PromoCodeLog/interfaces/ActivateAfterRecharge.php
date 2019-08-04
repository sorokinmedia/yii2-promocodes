<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\interfaces;

/**
 * Interface ActivateAfterRecharge
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\interfaces
 */
interface ActivateAfterRecharge
{
    /**
     * @param int $operation_id
     * @return bool
     */
    public function activateAfterRecharge(int $operation_id): bool;
}
