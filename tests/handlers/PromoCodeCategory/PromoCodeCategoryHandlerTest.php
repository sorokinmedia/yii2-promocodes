<?php
namespace sorokinmedia\promocodes\tests\handlers\PromoCodeCategory;

use sorokinmedia\promocodes\handlers\PromoCodeCategory\PromoCodeCategoryHandler;
use sorokinmedia\promocodes\tests\entities\PromoCodeCategory\PromoCodeCategory;
use sorokinmedia\promocodes\tests\TestCase;

/**
 * Class PromoCodeCategoryHandlerTest
 * @package sorokinmedia\promocodes\tests\handlers\PromoCodeCategory
 */
class PromoCodeCategoryHandlerTest extends TestCase
{
    /**
     * @group promo-code-category-handler
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testHandler()
    {
        $this->initDb();
        $category = PromoCodeCategory::findOne(1);
        $handler = new PromoCodeCategoryHandler($category);
        $this->assertInstanceOf(PromoCodeCategoryHandler::class, $handler);
        $this->assertInstanceOf(PromoCodeCategory::class, $handler->promo_code_category);
    }
}