<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\actions;

use sorokinmedia\promocodes\handlers\PromoCode\PromoCodeHandler;

/**
 * Class Activate
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\actions
 */
class Activate extends AbstractAction
{
    /**
     * @return bool
     * @throws \yii\db\Exception
     * @throws \yii\web\ServerErrorHttpException
     */
    public function execute(): bool
    {
        $operation_id = (new PromoCodeHandler($this->promo_code_log->promoCode))->activate($this->promo_code_log->user);
        return $this->promo_code_log->setActivated($operation_id);
    }
}