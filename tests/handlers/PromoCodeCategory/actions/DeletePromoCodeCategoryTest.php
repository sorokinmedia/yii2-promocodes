<?php

namespace sorokinmedia\promocodes\tests\handlers\PromoCodeCategory\actions;

use sorokinmedia\promocodes\handlers\PromoCodeCategory\PromoCodeCategoryHandler;
use sorokinmedia\promocodes\tests\entities\PromoCodeCategory\PromoCodeCategory;
use sorokinmedia\promocodes\tests\TestCase;

/**
 * Class DeletePromoCodeCategoryTest
 * @package sorokinmedia\promocodes\tests\handlers\PromoCodeCategory\actions
 */
class DeletePromoCodeCategoryTest extends TestCase
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
        $category = PromoCodeCategory::findOne(1);
        $handler = new PromoCodeCategoryHandler($category);
        $this->assertTrue($handler->delete());
        $deleted_category = PromoCodeCategory::findOne(1);
        $this->assertNull($deleted_category);
    }
}