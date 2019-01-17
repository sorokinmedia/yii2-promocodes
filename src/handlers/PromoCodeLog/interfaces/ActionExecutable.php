<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\interfaces;

/**
 * Interface ActionExecutable
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\interfaces
 */
interface ActionExecutable
{
    /**
     * @return mixed
     */
    public function execute(): bool;
}