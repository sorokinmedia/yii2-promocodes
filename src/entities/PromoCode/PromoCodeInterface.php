<?php
namespace sorokinmedia\promocodes\entities\PromoCode;

use yii\db\ActiveQuery;
use yii\web\IdentityInterface;

/**
 * Interface PromoCodeInterface
 * @package sorokinmedia\promocodes\entities\PromoCode
 */
interface PromoCodeInterface
{
    /**
     * получение объекта категории
     * @return ActiveQuery
     */
    public function getCategory() : ActiveQuery;

    /**
     * получение объекта создателя
     * @return ActiveQuery
     */
    public function getCreator() : ActiveQuery;

    /**
     * получение объекта бенефициара
     * @return ActiveQuery
     */
    public function getBeneficiary() : ActiveQuery;

    /**
     * получение операций связанных с промокодом
     * @return ActiveQuery
     */
    public function getOperations() : ActiveQuery;

    /**
     * трансфер данных из формы в модель
     * @return void
     */
    public function getFromForm();

    /**
     * добавление модели в БД
     * @return bool
     */
    public function insertModel() : bool;

    /**
     * обновление модели в БД
     * @return bool
     */
    public function updateModel() : bool;

    /**
     * удаление модели из БД
     * @return bool
     */
    public function deleteModel() : bool;

    /**
     * проверка на активность промокода по датам
     * @return bool
     */
    public function isActive() : bool;

    /**
     * проверка на доступность старым пользователям
     * @return bool
     */
    public function isAvailableForOld() : bool;

    /**
     * обзая проверка промокода на возможность активации конкретным пользователем
     * @param IdentityInterface $user
     * @return bool
     */
    public function checkCode(IdentityInterface $user) : bool;
}