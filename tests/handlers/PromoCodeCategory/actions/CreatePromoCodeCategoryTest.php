<?php

namespace sorokinmedia\promocodes\tests\handlers\PromoCodeCategory\actions;

use sorokinmedia\promocodes\forms\PromoCodeCategoryForm;
use sorokinmedia\promocodes\handlers\PromoCodeCategory\PromoCodeCategoryHandler;
use sorokinmedia\promocodes\tests\entities\PromoCodeCategory\PromoCodeCategory;
use sorokinmedia\promocodes\tests\TestCase;

/**
 * Class CreatePromoCodeCategoryTest
 * @package sorokinmedia\promocodes\tests\handlers\PromoCodeCategory\actions
 */
class CreatePromoCodeCategoryTest extends TestCase
{
    /**
     * @group promo-code-category-handler
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testAction()
    {
        $this->initDb();
        $this->initDbAdditional();
        $category = new PromoCodeCategory();
        $category_form = new PromoCodeCategoryForm([
            'name' => 'test_create',
            'parent_id' => null
        ], $category);
        $category->form = $category_form;
        $handler = new PromoCodeCategoryHandler($category);
        $this->assertTrue($handler->create());
        $category->refresh();
        $this->assertInstanceOf(PromoCodeCategory::class, $category);
        $this->assertEquals('test_create', $category->name);
        $this->assertEquals(0, $category->parent_id);
        $this->assertEquals(0, $category->has_child);
        $this->assertEquals(0, $category->is_deleted);
    }
}