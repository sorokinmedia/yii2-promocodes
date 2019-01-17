<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\interfaces;

/**
 * Interface Activate
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\interfaces
 */
interface Activate
{
    /**
     * @return bool
     */
    public function activate(): bool;
}