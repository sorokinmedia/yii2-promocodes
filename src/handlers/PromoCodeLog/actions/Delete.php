<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\actions;

/**
 * Class Delete
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\actions
 */
class Delete extends AbstractAction
{
    /**
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\Exception
     */
    public function execute(): bool
    {
        return $this->promo_code_log->deleteModel();
    }
}