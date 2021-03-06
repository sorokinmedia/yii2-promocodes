<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog;

use sorokinmedia\promocodes\entities\PromoCodeLog\AbstractPromoCodeLog;
use sorokinmedia\promocodes\handlers\PromoCodeLog\interfaces\{Activate,
    ActivateAfterRecharge,
    ActivatePercentageDiscount,
    Deactivate,
    Delete,
    Overdue,
    SetUsed};
use Throwable;
use yii\db\Exception;

/**
 * Class PromoCodeLogHandler
 * @package sorokinmedia\promocodes\handlers\PromoCodeCategory
 *
 * @property AbstractPromoCodeLog $promo_code_log
 */
class PromoCodeLogHandler implements Delete, Overdue, Activate, ActivatePercentageDiscount, ActivateAfterRecharge, Deactivate, SetUsed
{
    public $promo_code_log;

    /**
     * PromoCodeLogHandler constructor.
     * @param AbstractPromoCodeLog $promoCodeLog
     */
    public function __construct(AbstractPromoCodeLog $promoCodeLog)
    {
        $this->promo_code_log = $promoCodeLog;
    }

    /**
     * @return bool
     * @throws Exception
     * @throws Throwable
     */
    public function delete(): bool
    {
        return (new actions\Delete($this->promo_code_log))->execute();
    }

    /**
     * @return bool
     * @throws Exception
     * @throws Throwable
     */
    public function overdue(): bool
    {
        return (new actions\Overdue($this->promo_code_log))->execute();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function activate(): bool
    {
        return (new actions\Activate($this->promo_code_log))->execute();
    }

    /**
     * @param int $operation_id
     * @return bool
     * @throws \Exception
     */
    public function activatePercentageDiscount(int $operation_id): bool
    {
        return (new actions\ActivePercentageDiscount($this->promo_code_log, $operation_id))->execute();
    }

    /**
     * @param int $operation_id
     * @return bool
     * @throws \Exception
     */
    public function activateAfterRecharge(int $operation_id): bool
    {
        return (new actions\ActivateAfterRecharge($this->promo_code_log, $operation_id))->execute();
    }

    /**
     * @param int $operation_id
     * @return bool
     * @throws \Exception
     */
    public function deactivate(int $operation_id): bool
    {
        return (new actions\Deactivate($this->promo_code_log, $operation_id))->execute();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function setUsed(): bool
    {
        return (new actions\SetUsed($this->promo_code_log))->execute();
    }
}
