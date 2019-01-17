<?php

namespace sorokinmedia\promocodes\tests\entities\PromoCode;

use sorokinmedia\promocodes\forms\PromoCodeForm;
use sorokinmedia\promocodes\tests\entities\{PromoCodeCategory\PromoCodeCategory, User\User};
use sorokinmedia\promocodes\tests\TestCase;

/**
 * Class PromoCodeCategoryTest
 * @package sorokinmedia\promocodes\tests\entities\PromoCodeCategory
 */
class PromoCodeTest extends TestCase
{
    /**
     * @group promo-code
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testFields()
    {
        $this->initDb();
        $promo_code = new PromoCode();
        $this->assertEquals(
            [
                'id',
                'value',
                'title',
                'description',
                'cat_id',
                'type_id',
                'creator_id',
                'beneficiary_id',
                'date_from',
                'date_to',
                'sum_promo',
                'sum_recharge',
                'discount_fixed',
                'discount_percentage',
                'is_available_old',
            ],
            array_keys($promo_code->getAttributes())
        );
    }

    /**
     * @group promo-code
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testRelations()
    {
        $this->initDb();
        $this->initDbAdditional();
        $promo_code = PromoCode::findOne(1);
        $this->assertInstanceOf(PromoCode::class, $promo_code);
        $this->assertInstanceOf(PromoCodeCategory::class, $promo_code->getCategory()->one());
        $this->assertInstanceOf(User::class, $promo_code->getCreator()->one());
        $this->assertInstanceOf(User::class, $promo_code->getBeneficiary()->one());
    }

    /**
     * @group promo-code
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testGetFromForm()
    {
        $this->initDb();
        $this->initDbAdditional();
        $promo_code = PromoCode::findOne(1);
        $this->assertInstanceOf(PromoCode::class, $promo_code);
        $form = new PromoCodeForm([
            'value' => 'test_promo_form',
            'title' => 'тестовый промокод форма',
            'description' => 'описание промокода форма',
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
        ]);
        $promo_code->form = $form;
        $this->assertInstanceOf(PromoCodeForm::class, $promo_code->form);
        $promo_code->getFromForm();
        $this->assertEquals($form->value, $promo_code->value);
        $this->assertEquals($form->title, $promo_code->title);
        $this->assertEquals($form->description, $promo_code->description);
        $this->assertEquals($form->cat_id, $promo_code->cat_id);
        $this->assertEquals($form->type_id, $promo_code->type_id);
        $this->assertEquals($form->creator_id, $promo_code->creator_id);
        $this->assertEquals($form->beneficiary_id, $promo_code->beneficiary_id);
        $this->assertEquals($form->date_from, $promo_code->date_from);
        $this->assertEquals($form->date_to, $promo_code->date_to);
        $this->assertEquals($form->sum_promo, $promo_code->sum_promo);
        $this->assertEquals($form->sum_recharge, $promo_code->sum_recharge);
        $this->assertEquals($form->discount_fixed, $promo_code->discount_fixed);
        $this->assertEquals($form->discount_percentage, $promo_code->discount_percentage);
        $this->assertEquals($form->is_available_old, $promo_code->is_available_old);
    }

    /**
     * @group promo-code
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testInsertModel()
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
        $promo_code->insertModel();
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
        $this->assertEquals(false, $promo_code->is_available_old);
    }

    /**
     * @group promo-code
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testUpdateModel()
    {
        $this->initDb();
        /** @var PromoCodeCategory $category */
        $this->initDb();
        $this->initDbAdditional();
        $promo_code = PromoCode::findOne(1);
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
        $promo_code->updateModel();
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
        $this->assertEquals(false, $promo_code->is_available_old);
    }

    /**
     * @group promo-code
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testDeleteModel()
    {
        $this->initDb();
        /** @var PromoCode $promo_code */
        $promo_code = PromoCode::findOne(1);
        $promo_code->deleteModel();
        $deleted_promo_code = PromoCode::findOne(1);
        $this->assertNull($deleted_promo_code);
    }

    /**
     * @group promo-code
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testIsActive()
    {
        $this->initDb();
        $promo_code = PromoCode::findOne(1);
        $this->assertTrue($promo_code->isActive());
    }

    /**
     * @group promo-code
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testIsActiveFalse()
    {
        $this->initDb();
        $this->initDbAdditional();
        $promo_code = PromoCode::findOne(2);
        $this->assertFalse($promo_code->isAvailableForOld());
    }

    public function testIsAvailableForOld()
    {
        $this->initDb();
        $this->initDbAdditional();
        $promo_code = PromoCode::findOne(2);
    }

    /**
     * @group promo-code
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testCheckCode()
    {
        $this->initDb();
        $promo_code = PromoCode::findOne(1);
        $user = User::findOne(1);
        $this->assertTrue($promo_code->checkCode($user));
    }

    /**
     * @group promo-code
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testCheckAfterRechargeBeneficiary()
    {
        $this->initDb();
        $promo_code = PromoCode::findOne(1);
        $user = User::findOne(1);
        $this->assertTrue($promo_code->afterRechargeBeneficiary($user));
    }

    /**
     * @group promo-code
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testCheckAfterRechargePayment()
    {
        $this->initDb();
        $promo_code = PromoCode::findOne(1);
        $user = User::findOne(1);
        $this->assertEquals(0, $promo_code->afterRechargePayment($user));
    }
}