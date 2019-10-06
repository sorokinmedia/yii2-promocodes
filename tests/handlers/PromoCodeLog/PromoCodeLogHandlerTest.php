<?php

namespace sorokinmedia\promocodes\tests\handlers\PromoCodeLog;

use sorokinmedia\promocodes\handlers\PromoCodeLog\PromoCodeLogHandler;
use sorokinmedia\promocodes\tests\entities\PromoCodeLog\PromoCodeLog;
use sorokinmedia\promocodes\tests\TestCase;
use yii\base\InvalidConfigException;
use yii\db\Exception;

/**
 * Class PromoCodeLogHandlerTest
 * @package sorokinmedia\promocodes\tests\handlers\PromoCodeLog
 */
class PromoCodeLogHandlerTest extends TestCase
{
    /**
     * @group promo-code-log-handler
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testHandler(): void
    {
        $this->initDb();
        $promo_log = PromoCodeLog::findOne(1);
        $handler = new PromoCodeLogHandler($promo_log);
        $this->assertInstanceOf(PromoCodeLogHandler::class, $handler);
        $this->assertInstanceOf(PromoCodeLog::class, $handler->promo_code_log);
    }
}
