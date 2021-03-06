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
class OverduePromoCodeLogTest extends TestCase
{
    /**
     * @group promo-code-log-handler
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testAction(): void
    {
        $this->initDb();
        $this->initDbAdditional();
        $promo_code_log = PromoCodeLog::findOne(1);
        $handler = new PromoCodeLogHandler($promo_code_log);
        $this->assertTrue($handler->overdue());
        $promo_code_log->refresh();
        $this->assertEquals(PromoCodeLog::STATUS_OVERDUE, $promo_code_log->status_id);
    }
}
