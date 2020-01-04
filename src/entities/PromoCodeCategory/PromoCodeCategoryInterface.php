<?php

namespace sorokinmedia\promocodes\entities\PromoCodeCategory;

use yii\db\ActiveQuery;

/**
 * Interface PromoCodeCategoryInterface
 * @package sorokinmedia\promocodes\entities\PromoCodeCategory
 */
interface PromoCodeCategoryInterface
{
    /**
     * статический конструктор
     * @param string $name
     * @param int $parent_id
     * @return PromoCodeCategoryInterface
     */
    public static function create(string $name, int $parent_id = 0): PromoCodeCategoryInterface;

    /**
     * массив родительских элементов
     * @return array
     */
    public static function getParentsArray(): array;

    /**
     * получить объекты промокодов
     * @return ActiveQuery
     */
    public function getPromoCodes(): ActiveQuery;

    /**
     * получить объекты промокодов, которые не удалены
     * @return ActiveQuery
     */
    public function getNotDeletedPromoCodes(): ActiveQuery;

    /**
     * получить родительскую категорию
     * @return ActiveQuery
     */
    public function getParent(): ActiveQuery;

    /**
     * трансфер данных из формы в модель
     * @return void
     */
    public function getFromForm(): void;

    /**
     * добавление модели в БД
     * @return bool
     */
    public function insertModel(): bool;

    /**
     * обновление модели в БД
     * @return bool
     */
    public function updateModel(): bool;

    /**
     * удаление модели в БД
     * @return bool
     */
    public function deleteModel(): bool;

    /**
     * обновление родительского элемента
     * @param int|null $old_parent_id
     * @return bool
     */
    public function updateParent(int $old_parent_id = null): bool;

    /**
     * обновление атрибута has_child
     * @param int $has_child
     * @return bool
     */
    public function hasChildUpdate(int $has_child): bool;
}
