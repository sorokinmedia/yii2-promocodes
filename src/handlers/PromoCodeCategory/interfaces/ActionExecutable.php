<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeCategory\interfaces;

/**
 * Interface ActionExecutable
 * @package sorokinmedia\promocodes\handlers\PromoCodeCategory\interfaces
 */
interface ActionExecutable
{
    /**
     * @return mixed
     */
    public function execute(): bool;
}