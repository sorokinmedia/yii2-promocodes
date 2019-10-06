<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\actions;

use Throwable;
use yii\db\Exception;

/**
 * Class Delete
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\actions
 */
class Delete extends AbstractAction
{
    /**
     * @return bool
     * @throws Throwable
     * @throws Exception
     */
    public function execute(): bool
    {
        return $this->promo_code_log->deleteModel();
    }
}
