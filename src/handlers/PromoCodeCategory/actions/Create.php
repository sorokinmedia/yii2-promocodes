<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeCategory\actions;

use Throwable;
use yii\db\Exception;

/**
 * Class Create
 * @package sorokinmedia\promocodes\handlers\PromoCodeCategory\actions
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
        return $this->promo_code_category->insertModel();
    }
}
