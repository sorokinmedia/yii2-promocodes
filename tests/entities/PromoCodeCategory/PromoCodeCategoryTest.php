<?php

namespace sorokinmedia\promocodes\tests\entities\PromoCodeCategory;

use sorokinmedia\promocodes\forms\PromoCodeCategoryForm;
use sorokinmedia\promocodes\handlers\PromoCodeCategory\PromoCodeCategoryHandler;
use sorokinmedia\promocodes\tests\entities\PromoCode\PromoCode;
use sorokinmedia\promocodes\tests\TestCase;

/**
 * Class PromoCodeCategoryTest
 * @package sorokinmedia\promocodes\tests\entities\PromoCodeCategory
 */
class PromoCodeCategoryTest extends TestCase
{
    /**
     * @group promo-code-category
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testFields()
    {
        $this->initDb();
        $category = new PromoCodeCategory();
        $this->assertEquals(
            [
                'id',
                'name',
                'parent_id',
                'has_child',
            ],
            array_keys($category->getAttributes())
        );
    }

    /**
     * @group promo-code-category
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testRelations()
    {
        $this->initDb();
        $this->initDbAdditional();
        $category = PromoCodeCategory::findOne(1);
        $this->assertInstanceOf(PromoCodeCategory::class, $category);
        $this->assertInternalType('array', $category->getPromoCodes()->all());
        $this->assertInstanceOf(PromoCode::class, ($category->getPromoCodes()->all())[0]);

        $category_with_parent = PromoCodeCategory::findOne(3);
        $this->assertInstanceOf(PromoCodeCategory::class, $category_with_parent);
        $this->assertInstanceOf(PromoCodeCategory::class, $category_with_parent->getParent()->one());
    }

    /**
     * @group promo-code-category
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testGetFromForm()
    {
        $this->initDb();
        $category = PromoCodeCategory::findOne(1);
        $this->assertInstanceOf(PromoCodeCategory::class, $category);
        $form = new PromoCodeCategoryForm([
            'name' => 'test_form',
            'parent_id' => 2,
        ]);
        $category->form = $form;
        $this->assertInstanceOf(PromoCodeCategoryForm::class, $category->form);
        $category->getFromForm();
        $this->assertEquals($form->name, $category->name);
        $this->assertEquals($form->parent_id, $category->parent_id);
    }

    /**
     * @group promo-code-category
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     * @throws \yii\db\StaleObjectException
     */
    public function testInsertModel()
    {
        $this->initDb();
        $category = new PromoCodeCategory();
        $category_form = new PromoCodeCategoryForm([
            'name' => 'test_create',
            'parent_id' => null
        ], $category);
        $category->form = $category_form;
        $category->insertModel();
        $category->refresh();
        $this->assertInstanceOf(PromoCodeCategory::class, $category);
        $this->assertEquals('test_create', $category->name);
        $this->assertNull($category->parent_id);
        $this->assertFalse($category->has_child);
    }

    /**
     * @group promo-code-category
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testInsertModelWithParent()
    {
        $this->initDb();
        $category = new PromoCodeCategory();
        $category_form = new PromoCodeCategoryForm([
            'name' => 'test_create_child',
            'parent_id' => 1
        ], $category);
        $category->form = $category_form;
        $category->insertModel();
        $category->refresh();
        $this->assertInstanceOf(PromoCodeCategory::class, $category);
        $this->assertEquals('test_create_child', $category->name);
        $this->assertEquals(1, $category->parent_id);
        $this->assertFalse($category->has_child);
        $parent = PromoCodeCategory::findOne($category->parent_id);
        $this->assertEquals(true, $parent->has_child);
    }

    /**
     * @group promo-code-category
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testUpdateModel()
    {
        $this->initDb();
        /** @var PromoCodeCategory $category */
        $category = PromoCodeCategory::findOne(1);
        $form = new PromoCodeCategoryForm([
            'name' => 'test_update',
            'parent_id' => null
        ]);
        $category->form = $form;
        $category->updateModel();
        $category->refresh();
        $this->assertEquals('test_update', $category->name);
    }

    /**
     * @group promo-code-category
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testDeleteModel()
    {
        $this->initDb();
        /** @var PromoCodeCategory $category */
        $category = PromoCodeCategory::findOne(1);
        $category->deleteModel();
        $deleted_category = PromoCodeCategory::findOne(1);
        $this->assertNull($deleted_category);
    }

    /**
     * @group promo-code-category
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testStaticCreate()
    {
        $this->initDb();
        $category = PromoCodeCategory::create('test_static_create', 1);
        $this->assertInstanceOf(PromoCodeCategory::class, $category);
        $this->assertEquals('test_static_create', $category->name);
        $this->assertEquals(1, $category->parent_id);
        $this->assertFalse($category->has_child);
        $parent = PromoCodeCategory::findOne(1);
        $this->assertTrue($parent->has_child);
    }

    /**
     * @group promo-code-category
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testStaticCreateExisted()
    {
        $this->initDb();
        $category = PromoCodeCategory::create('test_category');
        $this->assertInstanceOf(PromoCodeCategory::class, $category);
        $this->assertEquals('test_category', $category->name);
        $this->assertNull($category->parent_id);
        $this->assertFalse($category->has_child);
    }
}