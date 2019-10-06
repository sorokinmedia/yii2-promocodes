<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\actions;

use sorokinmedia\promocodes\entities\PromoCodeLog\AbstractPromoCodeLog;

/**
 * Class AbstractActionWithOperation
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\actions
 *
 * @property AbstractPromoCodeLog $promo_code_log
 * @property int $operation_id
 */
abstract class AbstractActionWithOperation extends AbstractAction
{
    public $operation_id;

    /**
     * AbstractActionWithOperation constructor.
     * @param AbstractPromoCodeLog $promoCodeLog
     * @param int $operation_id
     */
    public function __construct(AbstractPromoCodeLog $promoCodeLog, int $operation_id)
    {
        $this->operation_id = $operation_id;
        parent::__construct($promoCodeLog);
    }
}
