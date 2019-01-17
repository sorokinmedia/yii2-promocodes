<?php
namespace sorokinmedia\promocodes\handlers\PromoCode\interfaces;

/**
 * Interface Activate
 * @package sorokinmedia\promocodes\handlers\PromoCode\interfaces
 */
interface Activate
{
    /**
     * @return int
     */
    public function activate() : int;
}