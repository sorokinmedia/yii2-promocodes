<?php
namespace sorokinmedia\promocodes\tests\forms;

use sorokinmedia\promocodes\forms\PromoCodeForm;
use sorokinmedia\promocodes\tests\entities\PromoCode\PromoCode;
use sorokinmedia\promocodes\tests\TestCase;

/**
 * Class PromoCodeFormTest
 * @package sorokinmedia\promocodes\tests\forms
 */
class PromoCodeFormTest extends TestCase
{
    /**
     * @group forms
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testConstruct()
    {
        $this->initDb();
        $code = PromoCode::findOne(1);
        $form = new PromoCodeForm([], $code);
        $this->assertInstanceOf(PromoCodeForm::class, $form);
        $this->assertEquals($form->value, $code->value);
        $this->assertEquals($form->title, $code->title);
        $this->assertEquals($form->description, $code->description);
        $this->assertEquals($form->cat_id, $code->cat_id);
        $this->assertEquals($form->type_id, $code->type_id);
        $this->assertEquals($form->creator_id, $code->creator_id);
        $this->assertEquals($form->beneficiary_id, $code->beneficiary_id);
        $this->assertEquals($form->date_from, $code->date_from);
        $this->assertEquals($form->date_to, $code->date_to);
        $this->assertEquals($form->sum_promo, $code->sum_promo);
        $this->assertEquals($form->sum_recharge, $code->sum_recharge);
        $this->assertEquals($form->discount_fixed, $code->discount_fixed);
        $this->assertEquals($form->discount_percentage, $code->discount_percentage);
        $this->assertEquals($form->is_available_old, $code->is_available_old);
    }
}