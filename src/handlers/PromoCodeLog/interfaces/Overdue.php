<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\interfaces;

/**
 * Interface Overdue
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\interfaces
 */
interface Overdue
{
    /**
     * @return bool
     */
    public function overdue(): bool;
}