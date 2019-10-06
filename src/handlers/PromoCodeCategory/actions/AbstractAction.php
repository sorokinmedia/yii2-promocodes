<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeCategory\actions;

use sorokinmedia\promocodes\entities\PromoCodeCategory\AbstractPromoCodeCategory;
use sorokinmedia\promocodes\handlers\PromoCodeCategory\interfaces\ActionExecutable;

/**
 * Class AbstractAction
 * @package sorokinmedia\promocodes\handlers\PromoCodeCategory\actions
 *
 * @property AbstractPromoCodeCategory $promo_code_category
 */
abstract class AbstractAction implements ActionExecutable
{
    protected $promo_code_category;

    /**
     * AbstractAction constructor.
     * @param AbstractPromoCodeCategory $promoCodeCategory
     */
    public function __construct(AbstractPromoCodeCategory $promoCodeCategory)
    {
        $this->promo_code_category = $promoCodeCategory;
    }
}
