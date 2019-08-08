<?php

namespace sorokinmedia\promocodes\handlers\PromoCode\actions;

use yii\db\Exception;

/**
 * Class Update
 * @package sorokinmedia\promocodes\handlers\PromoCode\actions
 */
class Update extends AbstractAction
{
    /**
     * @return bool
     * @throws Exception
     */
    public function execute(): bool
    {
        return $this->promo_code->updateModel();
    }
}
