<?php

namespace sorokinmedia\promocodes\tests\handlers\PromoCodeLog\actions;

use sorokinmedia\promocodes\handlers\PromoCodeLog\PromoCodeLogHandler;
use sorokinmedia\promocodes\tests\entities\PromoCodeLog\PromoCodeLog;
use sorokinmedia\promocodes\tests\TestCase;
use Throwable;
use yii\base\InvalidConfigException;
use yii\db\Exception;

/**
 * Class DeactivateTest
 * @package sorokinmedia\promocodes\tests\handlers\PromoCodeLog\actions
 */
class DeactivateTest extends TestCase
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
        $promo_code_log = PromoCodeLog::findOne(3);
        $handler = new PromoCodeLogHandler($promo_code_log);
        $this->assertTrue($handler->deactivate(15));
        $promo_code_log->refresh();
        $this->assertEquals(15, $promo_code_log->operation_id);
        $this->assertEquals(PromoCodeLog::STATUS_DEACTIVATED, $promo_code_log->status_id);
        $this->assertNotNull($promo_code_log->deactivated_at);
    }
}
