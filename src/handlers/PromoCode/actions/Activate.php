<?php

namespace sorokinmedia\promocodes\handlers\PromoCode\actions;

use Exception;
use sorokinmedia\promocodes\entities\PromoCode\AbstractPromoCode;
use Yii;
use yii\web\{IdentityInterface,ServerErrorHttpException};

/**
 * Class Activate
 * @package sorokinmedia\promocodes\handlers\PromoCode\actions
 *
 * @property IdentityInterface $user
 */
class Activate extends AbstractAction
{
    public $user;

    /**
     * Activate constructor.
     * @param AbstractPromoCode $promoCode
     * @param IdentityInterface $user
     */
    public function __construct(AbstractPromoCode $promoCode, IdentityInterface $user)
    {
        $this->user = $user;
        parent::__construct($promoCode);
    }

    /**
     * @return int
     * @throws ServerErrorHttpException
     */
    public function execute(): int
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $this->promo_code->afterRechargeBeneficiary($this->promo_code->beneficiary);
            $operation_id = $this->promo_code->afterRechargePayment($this->user);
            $this->promo_code->notifyAfterActivation($this->user);
            $transaction->commit();
            return $operation_id;
        } catch (Exception $e) {
            $transaction->rollBack();
            throw new ServerErrorHttpException($e->getTraceAsString());
        }
    }
}
