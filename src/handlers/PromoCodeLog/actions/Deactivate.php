<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\actions;

use Exception;
use sorokinmedia\promocodes\entities\PromoCodeLog\AbstractPromoCodeLog;
use Yii;

/**
 * Class Deactivate
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\actions
 *
 * @property int $operation_id
 */
class Deactivate extends AbstractAction
{
    public $operation_id;

    /**
     * Deactivate constructor.
     * @param AbstractPromoCodeLog $promoCodeLog
     * @param int $operation_id
     */
    public function __construct(AbstractPromoCodeLog $promoCodeLog, int $operation_id)
    {
        $this->operation_id = $operation_id;
        parent::__construct($promoCodeLog);
    }

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
