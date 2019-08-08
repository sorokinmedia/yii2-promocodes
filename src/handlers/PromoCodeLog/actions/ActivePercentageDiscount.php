<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\actions;

use Exception;
use Yii;

/**
 * Class ActivePercentageDiscount
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\actions
 */
class ActivePercentageDiscount extends AbstractActionWithOperation
{
    /**
     * @return bool
     * @throws Exception
     */
    public function execute(): bool
    {
        try {
            return $this->promo_code_log->setActivated($this->operation_id);
        } catch (Exception $exception) {
            throw new Exception(Yii::t('app', 'Ошибка при активации промокода, лог:{log_id}, {error}', [
                'log_id' => $this->promo_code_log->id,
                'error' => $exception->getMessage()
            ]));
        }
    }
}
