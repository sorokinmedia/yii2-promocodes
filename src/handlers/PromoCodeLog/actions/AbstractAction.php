<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog\actions;

use sorokinmedia\promocodes\entities\PromoCodeLog\AbstractPromoCodeLog;
use sorokinmedia\promocodes\handlers\PromoCodeLog\interfaces\ActionExecutable;

/**
 * Class AbstractAction
 * @package sorokinmedia\promocodes\handlers\PromoCodeLog\actions
 *
 * @property AbstractPromoCodeLog $promo_code_log
 */
abstract class AbstractAction implements ActionExecutable
{
    protected $promo_code_log;

    /**
     * AbstractAction constructor.
     * @param AbstractPromoCodeLog $promoCodeLog
     */
    public function __construct(AbstractPromoCodeLog $promoCodeLog)
    {
        $this->promo_code_log = $promoCodeLog;
    }
}
