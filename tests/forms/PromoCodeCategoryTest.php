<?php
namespace sorokinmedia\promocodes\tests\forms;

use sorokinmedia\promocodes\forms\PromoCodeCategoryForm;
use sorokinmedia\promocodes\forms\PromoCodeForm;
use sorokinmedia\promocodes\tests\entities\PromoCode\PromoCode;
use sorokinmedia\promocodes\tests\entities\PromoCodeCategory\PromoCodeCategory;
use sorokinmedia\promocodes\tests\TestCase;

/**
 * Class PromoCodeCategoryTest
 * @package sorokinmedia\promocodes\tests\forms
 */
class PromoCodeCategoryTest extends TestCase
{
    /**
     * @group forms
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testConstruct()
    {
        $this->initDb();
        $category = PromoCodeCategory::findOne(1);
        $form = new PromoCodeCategoryForm([], $category);
        $this->assertInstanceOf(PromoCodeCategoryForm::class, $form);
        $this->assertEquals($form->name, $category->name);
        $this->assertEquals($form->parent_id, $category->parent_id);
    }
}