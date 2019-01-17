<?php
namespace sorokinmedia\promocodes\handlers\PromoCode\actions;

use yii\db\Exception;
use yii\web\ServerErrorHttpException;

/**
 * Class Activate
 * @package sorokinmedia\promocodes\handlers\PromoCode\actions
 */
class Activate extends AbstractAction
{
    /**
     * @return int
     * @throws Exception
     * @throws ServerErrorHttpException
     */
    public function execute() : int
    {
        //todo: test transaction
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            $this->promo_code->afterRechargeBeneficiary();
            $operation_id = $this->promo_code->afterRechargePayment();
            $transaction->commit();
            return $operation_id;
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw new ServerErrorHttpException($e->getTraceAsString());
        }
    }
}