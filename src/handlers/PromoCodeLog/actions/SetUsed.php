<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\actions;

use Exception;
use Yii;

/**
 * Class SetUsed
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\actions
 */
class SetUsed extends AbstractAction
{
    /**
     * @return bool
     * @throws Exception
     */
    public function execute(): bool
    {
        try {
            return $this->promo_code_log->setUsed();
        } catch (Exception $exception) {
            throw new Exception(Yii::t('app', 'Ошибка при пометке использованным, лог:{log_id}, {error}', [
                'log_id' => $this->promo_code_log->id,
                'error' => $exception->getMessage()
            ]));
        }
    }
}
