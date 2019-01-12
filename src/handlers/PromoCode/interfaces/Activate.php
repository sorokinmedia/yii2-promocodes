<?php
namespace sorokinmedia\promocodes\handlers\PromoCode\interfaces;

/**
 * Interface Activate
 * @package sorokinmedia\promocodes\handlers\PromoCode\interfaces
 */
interface Activate
{
    /**
     * @return bool
     */
    public function activate() : bool;
}