<?php

namespace sorokinmedia\promocodes\handlers\PromoCode\actions;

use Throwable;
use yii\db\Exception;

/**
 * Class Create
 * @package sorokinmedia\promocodes\handlers\PromoCode\actions
 */
class Create extends AbstractAction
{
    /**
     * @return bool
     * @throws Throwable
     * @throws Exception
     */
    public function execute(): bool
    {
        return $this->promo_code->insertModel();
    }
}
