<?php
namespace sorokinmedia\promocodes\handlers\PromoCode\actions;

use sorokinmedia\promocodes\entities\PromoCode\AbstractPromoCode;
use sorokinmedia\promocodes\handlers\PromoCode\interfaces\ActionExecutable;

/**
 * Class AbstractAction
 * @package sorokinmedia\promocodes\handlers\PromoCode\actions
 *
 * @property AbstractPromoCode $promo_code
 */
abstract class AbstractAction implements ActionExecutable
{
    protected $promo_code;

    /**
     * AbstractAction constructor.
     * @param AbstractPromoCode $promoCode
     */
    public function __construct(AbstractPromoCode $promoCode)
    {
        $this->promo_code = $promoCode;
        return $this;
    }
}