<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\actions;

use Throwable;
use yii\db\Exception;

/**
 * Class Overdue
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\actions
 */
class Overdue extends AbstractAction
{
    /**
     * @return bool
     * @throws Throwable
     * @throws Exception
     */
    public function execute(): bool
    {
        return $this->promo_code_log->setOverdue();
    }
}
