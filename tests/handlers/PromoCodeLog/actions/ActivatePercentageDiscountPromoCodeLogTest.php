<?php

namespace sorokinmedia\promocodes\tests\handlers\PromoCodeLog\actions;

use sorokinmedia\promocodes\handlers\PromoCodeLog\PromoCodeLogHandler;
use sorokinmedia\promocodes\tests\entities\PromoCodeLog\PromoCodeLog;
use sorokinmedia\promocodes\tests\TestCase;

/**
 * Class ActivatePercentageDiscountPromoCodeLogTest
 * @package sorokinmedia\promocodes\tests\handlers\PromoCodeLog\actions
 */
class ActivatePercentageDiscountPromoCodeLogTest extends TestCase
{
    /**
     * @group promo-code-log-handler
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testAction()
    {
        $this->initDb();
        $this->initDbAdditional();
        $promo_code_log = PromoCodeLog::findOne(3);
        $handler = new PromoCodeLogHandler($promo_code_log);
        $this->assertTrue($handler->activatePercentageDiscount(15));
        $promo_code_log->refresh();
        $this->assertEquals(15, $promo_code_log->operation_id);
        $this->assertEquals(PromoCodeLog::STATUS_ACTIVATE, $promo_code_log->status_id);
    }
}