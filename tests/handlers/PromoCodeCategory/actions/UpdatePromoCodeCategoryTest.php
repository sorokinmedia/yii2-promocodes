<?php

namespace sorokinmedia\promocodes\tests\handlers\PromoCodeCategory\actions;

use sorokinmedia\promocodes\forms\PromoCodeCategoryForm;
use sorokinmedia\promocodes\handlers\PromoCodeCategory\PromoCodeCategoryHandler;
use sorokinmedia\promocodes\tests\entities\PromoCodeCategory\PromoCodeCategory;
use sorokinmedia\promocodes\tests\TestCase;
use Throwable;
use yii\base\InvalidConfigException;
use yii\db\Exception;

/**
 * Class UpdatePromoCodeCategoryTest
 * @package sorokinmedia\promocodes\tests\handlers\PromoCodeCategory\actions
 */
class UpdatePromoCodeCategoryTest extends TestCase
{
    /**
     * @group promo-code-category-handler
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testAction(): void
    {
        $this->initDb();
        $this->initDbAdditional();
        $category = PromoCodeCategory::findOne(1);
        $category_form = new PromoCodeCategoryForm([
            'name' => 'test_update',
            'parent_id' => null
        ], $category);
        $category->form = $category_form;
        $handler = new PromoCodeCategoryHandler($category);
        $this->assertTrue($handler->update());
        $category->refresh();
        $this->assertInstanceOf(PromoCodeCategory::class, $category);
        $this->assertEquals('test_update', $category->name);
    }
}
