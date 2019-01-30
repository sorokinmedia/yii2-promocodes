<?php

namespace sorokinmedia\promocodes\tests\handlers\PromoCode\actions;

use sorokinmedia\promocodes\handlers\PromoCode\PromoCodeHandler;
use sorokinmedia\promocodes\tests\entities\PromoCode\PromoCode;
use sorokinmedia\promocodes\tests\TestCase;

/**
 * Class DeletePromoCodeTest
 * @package sorokinmedia\promocodes\tests\handlers\PromoCode\actions
 */
class DeletePromoCodeTest extends TestCase
{
    /**
     * @group promo-code-handler
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testAction()
    {
        $this->initDb();
        $this->initDbAdditional();
        $promo_code = PromoCode::findOne(1);
        $handler = new PromoCodeHandler($promo_code);
        $this->assertTrue($handler->delete());
        $promo_code->refresh();
        $this->assertEquals(1, $promo_code->is_deleted);
    }
}