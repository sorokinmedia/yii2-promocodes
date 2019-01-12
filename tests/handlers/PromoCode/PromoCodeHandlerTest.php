<?php
namespace sorokinmedia\promocodes\tests\handlers\PromoCode;

use sorokinmedia\promocodes\handlers\PromoCode\PromoCodeHandler;
use sorokinmedia\promocodes\tests\entities\PromoCode\PromoCode;
use sorokinmedia\promocodes\tests\TestCase;

/**
 * Class PromoCodeHandlerTest
 * @package sorokinmedia\promocodes\tests\handlers\PromoCode
 */
class PromoCodeHandlerTest extends TestCase
{
    /**
     * @group promo-code-handler
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testHandler()
    {
        $this->initDb();
        $promo_code = PromoCode::findOne(1);
        $handler = new PromoCodeHandler($promo_code);
        $this->assertInstanceOf(PromoCodeHandler::class, $handler);
        $this->assertInstanceOf(PromoCode::class, $handler->promo_code);
    }
}