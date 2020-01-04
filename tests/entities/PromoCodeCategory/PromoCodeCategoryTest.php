<?php

namespace sorokinmedia\promocodes\tests\entities\PromoCodeCategory;

use sorokinmedia\promocodes\entities\PromoCodeCategory\PromoCodeCategoryTree;
use sorokinmedia\promocodes\forms\PromoCodeCategoryForm;
use sorokinmedia\promocodes\tests\{entities\PromoCode\PromoCode, TestCase};
use Throwable;
use yii\base\InvalidConfigException;
use yii\db\{Exception};

/**
 * Class PromoCodeCategoryTest
 * @package sorokinmedia\promocodes\tests\entities\PromoCodeCategory
 */
class PromoCodeCategoryTest extends TestCase
{
    /**
     * @group promo-code-category
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testFields(): void
    {
        $this->initDb();
        $category = new PromoCodeCategory();
        $this->assertEquals(
            [
                'id',
                'name',
                'parent_id',
                'has_child',
                'is_deleted'
            ],
            array_keys($category->getAttributes())
        );
    }

    /**
     * @group promo-code-category
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testRelations(): void
    {
        $this->initDb();
        $this->initDbAdditional();
        $category = PromoCodeCategory::findOne(1);
        $this->assertInstanceOf(PromoCodeCategory::class, $category);
        $this->assertIsArray($category->getPromoCodes()->all());
        $this->assertInstanceOf(PromoCode::class, ($category->getPromoCodes()->all())[0]);
        $this->assertIsArray($category->getNotDeletedPromoCodes()->all());
        $this->assertInstanceOf(PromoCode::class, ($category->getNotDeletedPromoCodes()->all())[0]);

        $category_with_parent = PromoCodeCategory::findOne(3);
        $this->assertInstanceOf(PromoCodeCategory::class, $category_with_parent);
        $this->assertInstanceOf(PromoCodeCategory::class, $category_with_parent->getParent()->one());
    }

    /**
     * @group promo-code-category
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testGetFromForm(): void
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
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testInsertModel(): void
    {
        $this->initDb();
        $category = new PromoCodeCategory();
        $category_form = new PromoCodeCategoryForm([
            'name' => 'test_create',
            'parent_id' => 0
        ], $category);
        $category->form = $category_form;
        $category->insertModel();
        $category->refresh();
        $this->assertInstanceOf(PromoCodeCategory::class, $category);
        $this->assertEquals('test_create', $category->name);
        $this->assertEquals(0, $category->parent_id);
        $this->assertEquals(0, $category->has_child);
        $this->assertEquals(0, $category->is_deleted);
    }

    /**
     * @group promo-code-category
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testInsertModelWithParent(): void
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
        $this->assertEquals(0, $category->is_deleted);
        $this->assertEquals(0, $category->has_child);
        $parent = PromoCodeCategory::findOne($category->parent_id);
        $this->assertEquals(true, $parent->has_child);
    }

    /**
     * @group promo-code-category
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testUpdateModel(): void
    {
        $this->initDb();
        /** @var PromoCodeCategory $category */
        $category = PromoCodeCategory::findOne(1);
        $form = new PromoCodeCategoryForm([
            'name' => 'test_update',
            'parent_id' => 0
        ]);
        $category->form = $form;
        $category->updateModel();
        $category->refresh();
        $this->assertEquals('test_update', $category->name);
    }

    /**
     * @group promo-code-category
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testDeleteModel(): void
    {
        $this->initDb();
        /** @var PromoCodeCategory $category */
        $category = PromoCodeCategory::findOne(1);
        $category->deleteModel();
        $category->refresh();
        $this->assertEquals(1, $category->is_deleted);
    }

    /**
     * @group promo-code-category
     * @throws Exception
     * @throws InvalidConfigException
     * @throws Throwable
     */
    public function testStaticCreate(): void
    {
        $this->initDb();
        $category = PromoCodeCategory::create('test_static_create', 1);
        $this->assertInstanceOf(PromoCodeCategory::class, $category);
        $this->assertEquals('test_static_create', $category->name);
        $this->assertEquals(1, $category->parent_id);
        $this->assertEquals(0, $category->has_child);
        $parent = PromoCodeCategory::findOne(1);
        $this->assertEquals(1, $parent->has_child);
    }

    /**
     * @group promo-code-category
     * @throws Exception
     * @throws InvalidConfigException
     * @throws Throwable
     */
    public function testStaticCreateExisted(): void
    {
        $this->initDb();
        $category = PromoCodeCategory::create('test_category');
        $this->assertInstanceOf(PromoCodeCategory::class, $category);
        $this->assertEquals('test_category', $category->name);
        $this->assertEquals(0, $category->parent_id);
        $this->assertEquals(0, $category->has_child);
    }

    /**
     * @group promo-code-category
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testGetParentsArray(): void
    {
        $this->initDb();
        $this->initDbAdditional();
        $array = PromoCodeCategory::getParentsArray();
        $this->assertEquals([
            '2' => 'test category parent',
            '1' => 'test_category'
        ], $array);
    }

    /**
     * @group promo-code-category
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testTree(): void
    {
        $this->initDb();
        $this->initDbAdditional();
        $tree = PromoCodeCategoryTree::makeTreeStaticArray(PromoCodeCategory::class, 0, '-');
        $this->assertIsArray($tree[0]);
        $this->assertEquals([
            [
                'id' => 2,
                'name' => '-test category parent',
            ],
            [
                'id' => 3,
                'name' => '--test category child'
            ],
            [
                'id' => 1,
                'name' => '-test_category'
            ]
        ], $tree);
    }
}
