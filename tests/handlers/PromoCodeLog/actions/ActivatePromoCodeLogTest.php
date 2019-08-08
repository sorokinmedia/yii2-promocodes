<?php

namespace sorokinmedia\promocodes\tests\handlers\PromoCodeLog\actions;

use sorokinmedia\promocodes\handlers\PromoCodeLog\PromoCodeLogHandler;
use sorokinmedia\promocodes\tests\entities\PromoCodeLog\PromoCodeLog;
use sorokinmedia\promocodes\tests\TestCase;
use Throwable;
use yii\base\InvalidConfigException;
use yii\db\Exception;

/**
 * Class OverduePromoCodeLogTest
 * @package sorokinmedia\promocodes\tests\handlers\PromoCodeLog\actions
 */
class ActivatePromoCodeLogTest extends TestCase
{
    /**
     * @group promo-code-log-handler
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
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
        $this->assertEquals(PromoCodeLog::STATUS_ACTIVATED, $promo_code_log->status_id);
        $this->assertNotNull($promo_code_log->activated_at);
    }
}
