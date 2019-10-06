<?php

namespace sorokinmedia\promocodes\tests\forms;

use sorokinmedia\promocodes\forms\PromoCodeCategoryForm;
use sorokinmedia\promocodes\tests\entities\PromoCodeCategory\PromoCodeCategory;
use sorokinmedia\promocodes\tests\TestCase;
use yii\base\InvalidConfigException;
use yii\db\Exception;

/**
 * Class PromoCodeCategoryTest
 * @package sorokinmedia\promocodes\tests\forms
 */
class PromoCodeCategoryTest extends TestCase
{
    /**
     * @group forms
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testConstruct(): void
    {
        $this->initDb();
        $category = PromoCodeCategory::findOne(1);
        $form = new PromoCodeCategoryForm([], $category);
        $this->assertInstanceOf(PromoCodeCategoryForm::class, $form);
        $this->assertEquals($form->name, $category->name);
        $this->assertEquals($form->parent_id, $category->parent_id);
    }
}
