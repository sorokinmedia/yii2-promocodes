<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeCategory\actions;

/**
 * Class Delete
 * @package sorokinmedia\promocodes\handlers\PromoCodeCategory\actions
 */
class Delete extends AbstractAction
{
    /**
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\Exception
     * @throws \yii\db\StaleObjectException
     */
    public function execute(): bool
    {
        return $this->promo_code_category->deleteModel();
    }
}