<?php

namespace sorokinmedia\promocodes\handlers\PromoCode;

use sorokinmedia\promocodes\entities\PromoCode\AbstractPromoCode;
use sorokinmedia\promocodes\handlers\PromoCode\interfaces\{Activate, Create, Deactivate, Delete, Update};
use Throwable;
use yii\db\Exception;
use yii\web\{IdentityInterface,ServerErrorHttpException};

/**
 * Class PromoCodeHandler
 * @package common\components\promoCode\handlers\PromoCode
 *
 * @property AbstractPromoCode $promo_code
 */
class PromoCodeHandler implements Create, Update, Delete, Activate, Deactivate
{
    public $promo_code;

    /**
     * PromoCodeHandler constructor.
     * @param AbstractPromoCode $promoCode
     */
    public function __construct(AbstractPromoCode $promoCode)
    {
        $this->promo_code = $promoCode;
    }

    /**
     * @return bool
     * @throws Throwable
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
     * @throws Throwable
     */
    public function delete(): bool
    {
        return (new actions\Delete($this->promo_code))->execute();
    }

    /**
     * @param IdentityInterface $user
     * @return int
     * @throws ServerErrorHttpException
     */
    public function activate(IdentityInterface $user): int
    {
        return (new actions\Activate($this->promo_code, $user))->execute();
    }

    /**
     * @param IdentityInterface $user
     * @return int
     * @throws ServerErrorHttpException
     */
    public function deactivate(IdentityInterface $user): int
    {
        return (new actions\Deactivate($this->promo_code, $user))->execute();
    }
}
