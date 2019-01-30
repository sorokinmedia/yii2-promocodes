<?php

namespace sorokinmedia\promocodes\tests\handlers\PromoCode\actions;

use sorokinmedia\promocodes\forms\PromoCodeForm;
use sorokinmedia\promocodes\handlers\PromoCode\PromoCodeHandler;
use sorokinmedia\promocodes\tests\entities\PromoCode\PromoCode;
use sorokinmedia\promocodes\tests\TestCase;

/**
 * Class CreatePromoCodeTest
 * @package sorokinmedia\promocodes\tests\handlers\PromoCode\actions
 */
class CreatePromoCodeTest extends TestCase
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
        $promo_code = new PromoCode();
        $promo_code_form = new PromoCodeForm([
            'value' => 'test_promo_update',
            'title' => 'тестовый промокод апдейт',
            'description' => 'описание промокода апдейт',
            'cat_id' => 2,
            'type_id' => 2,
            'creator_id' => 2,
            'beneficiary_id' => 2,
            'date_from' => 1514764700,
            'date_to' => 1577836700,
            'sum_promo' => 2000,
            'sum_recharge' => 4000,
            'discount_fixed' => 100,
            'discount_percentage' => 10,
            'is_available_old' => 0
        ], $promo_code);
        $promo_code->form = $promo_code_form;
        $handler = new PromoCodeHandler($promo_code);
        $this->assertTrue($handler->create());
        $promo_code->refresh();
        $this->assertInstanceOf(PromoCode::class, $promo_code);
        $this->assertEquals('test_promo_update', $promo_code->value);
        $this->assertEquals('тестовый промокод апдейт', $promo_code->title);
        $this->assertEquals('описание промокода апдейт', $promo_code->description);
        $this->assertEquals(2, $promo_code->cat_id);
        $this->assertEquals(2, $promo_code->type_id);
        $this->assertEquals(2, $promo_code->creator_id);
        $this->assertEquals(2, $promo_code->beneficiary_id);
        $this->assertEquals(1514764700, $promo_code->date_from);
        $this->assertEquals(1577836700, $promo_code->date_to);
        $this->assertEquals(2000, $promo_code->sum_promo);
        $this->assertEquals(4000, $promo_code->sum_recharge);
        $this->assertEquals(100, $promo_code->discount_fixed);
        $this->assertEquals(10, $promo_code->discount_percentage);
        $this->assertEquals(0, $promo_code->is_available_old);
        $this->assertEquals(0, $promo_code->is_deleted);
    }
}