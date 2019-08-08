<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeCategory;

use sorokinmedia\promocodes\entities\PromoCodeCategory\AbstractPromoCodeCategory;
use sorokinmedia\promocodes\handlers\PromoCodeCategory\interfaces\{Create, Delete, Update};
use Throwable;
use yii\db\Exception;

/**
 * Class PromoCodeCategoryHandler
 * @package sorokinmedia\promocodes\handlers\PromoCodeCategory
 *
 * @property AbstractPromoCodeCategory $promo_code_category
 */
class PromoCodeCategoryHandler implements Create, Update, Delete
{
    public $promo_code_category;

    /**
     * PromoCodeCategoryHandler constructor.
     * @param AbstractPromoCodeCategory $promoCodeCategory
     */
    public function __construct(AbstractPromoCodeCategory $promoCodeCategory)
    {
        $this->promo_code_category = $promoCodeCategory;
        return $this;
    }

    /**
     * @return bool
     * @throws Throwable
     * @throws Exception
     */
    public function create(): bool
    {
        return (new actions\Create($this->promo_code_category))->execute();
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function update(): bool
    {
        return (new actions\Update($this->promo_code_category))->execute();
    }

    /**
     * @return bool
     * @throws Throwable
     */
    public function delete(): bool
    {
        return (new actions\Delete($this->promo_code_category))->execute();
    }
}
