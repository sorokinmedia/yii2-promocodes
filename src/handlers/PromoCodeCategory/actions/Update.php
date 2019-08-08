<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeCategory\actions;

use yii\db\Exception;

/**
 * Class Update
 * @package sorokinmedia\promocodes\handlers\PromoCodeCategory\actions
 */
class Update extends AbstractAction
{
    /**
     * @return bool
     * @throws Exception
     */
    public function execute(): bool
    {
        return $this->promo_code_category->updateModel();
    }
}
