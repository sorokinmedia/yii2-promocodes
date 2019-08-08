<?php

namespace sorokinmedia\promocodes\handlers\PromoCode\interfaces;

use yii\web\IdentityInterface;

/**
 * Interface Activate
 * @package sorokinmedia\promocodes\handlers\PromoCode\interfaces
 */
interface Activate
{
    /**
     * @param IdentityInterface $user
     * @return int
     */
    public function activate(IdentityInterface $user): int;
}
