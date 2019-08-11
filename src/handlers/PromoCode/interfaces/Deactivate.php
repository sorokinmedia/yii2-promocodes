<?php

namespace sorokinmedia\promocodes\handlers\PromoCode\interfaces;

use yii\web\IdentityInterface;

/**
 * Interface Deactivate
 * @package sorokinmedia\promocodes\handlers\PromoCode\interfaces
 */
interface Deactivate
{
    /**
     * @param IdentityInterface $user
     * @return int
     */
    public function deactivate(IdentityInterface $user): int;
}
