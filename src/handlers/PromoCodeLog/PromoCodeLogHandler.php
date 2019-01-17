<?php

namespace sorokinmedia\promocodes\handlers\PromoCodeLog;

use sorokinmedia\promocodes\entities\PromoCodeLog\AbstractPromoCodeLog;
use sorokinmedia\promocodes\handlers\PromoCodeLog\interfaces\{Create, Delete, Update, Ovedue};
use yii\db\Exception;

/**
 * Class PromoCodeLogHandler
 * @package sorokinmedia\promocodes\handlers\PromoCodeCategory
 *
 * @property AbstractPromoCodeLog $promo_code_log
 */
class PromoCodeLogHandler implements Create, Update, Delete, Overdue
{
    public $promo_code_log;

    /**
     * PromoCodeLogHandler constructor.
     * @param AbstractPromoCodeLog $promoCodeLog
     */
    public function __construct(AbstractPromoCodeLog $promoCodeLog)
    {
        $this->promo_code_log = $promoCodeLog;
        return $this;
    }

    /**
     * @return bool
     * @throws \Throwable
     * @throws Exception
     */
    public function create(): bool
    {
        return (new actions\Create($this->promo_code_log))->execute();
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function update(): bool
    {
        return (new actions\Update($this->promo_code_log))->execute();
    }

    /**
     * @return bool
     * @throws \Throwable
     */
    public function delete(): bool
    {
        return (new actions\Delete($this->promo_code_log))->execute();
    }

    /**
     * @return bool
     */
    public function overdue() : bool
    {
        return (new actions\Overdue($this->promo_code_log))->execute();
    }
}