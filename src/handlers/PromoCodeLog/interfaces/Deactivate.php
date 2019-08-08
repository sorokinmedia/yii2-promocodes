<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\interfaces;

/**
 * Interface Deactivate
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\interfaces
 */
interface Deactivate
{
    /**
     * @param int $operation_id
     * @return bool
     */
    public function deactivate(int $operation_id): bool;
}
