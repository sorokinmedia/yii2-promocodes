<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeCategory\actions;

use Throwable;
use yii\db\Exception;
use yii\db\StaleObjectException;

/**
 * Class Delete
 * @package sorokinmedia\promocodes\handlers\PromoCodeCategory\actions
 */
class Delete extends AbstractAction
{
    /**
     * @return bool
     * @throws Throwable
     * @throws Exception
     * @throws StaleObjectException
     */
    public function execute(): bool
    {
        return $this->promo_code_category->deleteModel();
    }
}
