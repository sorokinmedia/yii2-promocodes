<?php

namespace sorokinmedia\promocodes\handlers\PromoCode\actions;

use Throwable;

/**
 * Class Delete
 * @package sorokinmedia\promocodes\handlers\PromoCode\actions
 */
class Delete extends AbstractAction
{
    /**
     * @return bool
     * @throws Throwable
     */
    public function execute(): bool
    {
        return $this->promo_code->deleteModel();
    }
}
