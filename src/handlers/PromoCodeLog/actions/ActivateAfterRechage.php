<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\actions;

use Exception;
use sorokinmedia\promocodes\entities\PromoCodeLog\AbstractPromoCodeLog;
use Yii;

/**
 * Class ActivateAfterRechage
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\actions
 *
 * @property int $operation_id
 */
class ActivateAfterRechage extends AbstractAction
{
    public $operation_id;

    /**
     * ActivePercentageDiscount constructor.
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
            return $this->promo_code_log->setActivated($this->operation_id);
        } catch (Exception $exception) {
            throw new Exception(Yii::t('app', 'Ошибка при активации промокода, лог:{log_id}, {error}', [
                'log_id' => $this->promo_code_log->id,
                'error' => $exception->getMessage()
            ]));
        }
    }
}
