<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeCategory\actions;

/**
 * Class Create
 * @package sorokinmedia\promocodes\handlers\PromoCodeCategory\actions
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
        return $this->promo_code_category->insertModel();
    }
}