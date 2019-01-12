<?php

namespace sorokinmedia\promocodes\handlers\PromoCode\actions;

/**
 * Class Create
 * @package sorokinmedia\promocodes\handlers\PromoCode\actions
 */
class Create extends AbstractAction
{
    /**
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\Exception
     */
    public function execute(): bool
    {
        return $this->promo_code->insertModel();
    }
}