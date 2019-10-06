<?php

namespace sorokinmedia\promocodes\tests\handlers\PromoCodeCategory;

use sorokinmedia\promocodes\handlers\PromoCodeCategory\PromoCodeCategoryHandler;
use sorokinmedia\promocodes\tests\entities\PromoCodeCategory\PromoCodeCategory;
use sorokinmedia\promocodes\tests\TestCase;
use yii\base\InvalidConfigException;
use yii\db\Exception;

/**
 * Class PromoCodeCategoryHandlerTest
 * @package sorokinmedia\promocodes\tests\handlers\PromoCodeCategory
 */
class PromoCodeCategoryHandlerTest extends TestCase
{
    /**
     * @group promo-code-category-handler
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testHandler(): void
    {
        $this->initDb();
        $category = PromoCodeCategory::findOne(1);
        $handler = new PromoCodeCategoryHandler($category);
        $this->assertInstanceOf(PromoCodeCategoryHandler::class, $handler);
        $this->assertInstanceOf(PromoCodeCategory::class, $handler->promo_code_category);
    }
}
