<?php

namespace sorokinmedia\promocodes\handlers\PromoCode\interfaces;

/**
 * Interface ActionExecutable
 * @package sorokinmedia\promocodes\handlers\PromoCode\interfaces
 */
interface ActionExecutable
{
    /**
     * @return mixed
     */
    public function execute();
}