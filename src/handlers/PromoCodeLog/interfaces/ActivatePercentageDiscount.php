<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\interfaces;

/**
 * Interface ActivatePercentageDiscount
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\interfaces
 */
interface ActivatePercentageDiscount
{
    /**
     * @param int $operation_id
     * @return bool
     */
    public function activatePercentageDiscount(int $operation_id): bool;
}