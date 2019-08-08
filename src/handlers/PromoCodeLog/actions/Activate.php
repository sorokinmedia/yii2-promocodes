<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\actions;

use Exception;
use sorokinmedia\promocodes\handlers\PromoCode\PromoCodeHandler;
use Yii;

/**
 * Class Activate
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\actions
 */
class Activate extends AbstractAction
{
    /**
     * @return bool
     * @throws Exception
     */
    public function execute(): bool
    {
        try {
            $operation_id = (new PromoCodeHandler($this->promo_code_log->promoCode))->activate($this->promo_code_log->user);
            return $this->promo_code_log->setActivated($operation_id);
        } catch (Exception $exception) {
            throw new Exception(Yii::t('app', 'Ошибка при активации промокода, лог:{log_id}, {error}', [
                'log_id' => $this->promo_code_log->id,
                'error' => $exception->getMessage()
            ]));
        }
    }
}
