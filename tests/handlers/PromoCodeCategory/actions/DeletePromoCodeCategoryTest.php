<?php

namespace sorokinmedia\promocodes\tests\handlers\PromoCodeCategory\actions;

use sorokinmedia\promocodes\handlers\PromoCodeCategory\PromoCodeCategoryHandler;
use sorokinmedia\promocodes\tests\entities\PromoCodeCategory\PromoCodeCategory;
use sorokinmedia\promocodes\tests\TestCase;
use Throwable;
use yii\base\InvalidConfigException;
use yii\db\Exception;

/**
 * Class DeletePromoCodeCategoryTest
 * @package sorokinmedia\promocodes\tests\handlers\PromoCodeCategory\actions
 */
class DeletePromoCodeCategoryTest extends TestCase
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
        $handler = new PromoCodeCategoryHandler($category);
        $this->assertTrue($handler->delete());
        $category->refresh();
        $this->assertEquals(1, $category->is_deleted);
    }
}
