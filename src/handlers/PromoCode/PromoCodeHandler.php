<?php

namespace sorokinmedia\promocodes\handlers\PromoCode;

use sorokinmedia\promocodes\entities\PromoCode\AbstractPromoCode;
use sorokinmedia\promocodes\handlers\PromoCode\interfaces\{Activate, Create, Delete, Update};
use yii\db\Exception;
use yii\web\IdentityInterface;

/**
 * Class PromoCodeHandler
 * @package common\components\promoCode\handlers\PromoCode
 *
 * @property AbstractPromoCode $promo_code
 */
class PromoCodeHandler implements Create, Update, Delete, Activate
{
    public $promo_code;

    /**
     * PromoCodeHandler constructor.
     * @param AbstractPromoCode $promoCode
     */
    public function __construct(AbstractPromoCode $promoCode)
    {
        $this->promo_code = $promoCode;
        return $this;
    }

    /**
     * @return bool
     * @throws \Throwable
     * @throws Exception
     */
    public function create(): bool
    {
        return (new actions\Create($this->promo_code))->execute();
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function update(): bool
    {
        return (new actions\Update($this->promo_code))->execute();
    }

    /**
     * @return bool
     * @throws \Throwable
     */
    public function delete(): bool
    {
        return (new actions\Delete($this->promo_code))->execute();
    }

    /**
     * @param IdentityInterface $user
     * @return int
     * @throws Exception
     * @throws \yii\web\ServerErrorHttpException
     */
    public function activate(IdentityInterface $user): int
    {
        return (new actions\Activate($this->promo_code, $user))->execute();
    }
}