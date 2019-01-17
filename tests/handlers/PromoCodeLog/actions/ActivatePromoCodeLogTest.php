<?php

namespace sorokinmedia\promocodes\tests\handlers\PromoCodeLog\actions;

use sorokinmedia\promocodes\handlers\PromoCodeLog\PromoCodeLogHandler;
use sorokinmedia\promocodes\tests\entities\PromoCodeLog\PromoCodeLog;
use sorokinmedia\promocodes\tests\TestCase;

/**
 * Class OverduePromoCodeLogTest
 * @package sorokinmedia\promocodes\tests\handlers\PromoCodeLog\actions
 */
class ActivatePromoCodeLogTest extends TestCase
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
        $promo_code_log = PromoCodeLog::findOne(2);
        $handler = new PromoCodeLogHandler($promo_code_log);
        $this->assertTrue($handler->activate());
        $promo_code_log->refresh();
        $this->assertEquals(0, $promo_code_log->operation_id);
        $this->assertEquals(PromoCodeLog::STATUS_ACTIVATE, $promo_code_log->status_id);
    }
}