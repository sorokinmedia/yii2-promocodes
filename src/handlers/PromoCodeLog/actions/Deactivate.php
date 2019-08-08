<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\actions;

use Exception;
use Yii;

/**
 * Class Deactivate
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\actions
 */
class Deactivate extends AbstractActionWithOperation
{
    /**
     * @return bool
     * @throws Exception
     */
    public function execute(): bool
    {
        try {
            return $this->promo_code_log->setDeactivated($this->operation_id);
        } catch (Exception $exception) {
            throw new Exception(Yii::t('app', 'Ошибка при деактивации промокода, лог:{log_id}, {error}', [
                'log_id' => $this->promo_code_log->id,
                'error' => $exception->getMessage()
            ]));
        }
    }
}
