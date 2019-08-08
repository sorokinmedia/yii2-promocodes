<?php

namespace sorokinmedia\promocodes\entities\PromoCodeLog;

use sorokinmedia\promocodes\entities\PromoCode\AbstractPromoCode;
use yii\db\ActiveQuery;
use yii\web\IdentityInterface;

/**
 * Interface PromoCodeLogInterface
 * @package sorokinmedia\promocodes\entities\PromoCodeLog
 */
interface PromoCodeLogInterface
{
    /**
     * получить массив статусов или текстовку
     * @param int|null $status_id
     * @return mixed
     */
    public static function getStatuses(int $status_id = null);

    /**
     * статический конструктор
     * @param AbstractPromoCode $promoCode
     * @param IdentityInterface $user
     * @return PromoCodeLogInterface
     */
    public static function create(AbstractPromoCode $promoCode, IdentityInterface $user): PromoCodeLogInterface;

    /**
     * получить объект пользователя
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery;

    /**
     * получить объект промокода
     * @return ActiveQuery
     */
    public function getPromoCode(): ActiveQuery;

    /**
     * получить текстовку статуса
     * @return string
     */
    public function getStatus(): string;

    /**
     * получить класс лейбла для статуса
     * @return string
     */
    public function getStatusLabel(): string;

    /**
     * пометить как активированный
     * @param int $operation_id
     * @return bool
     */
    public function setActivated(int $operation_id): bool;

    /**
     * пометить как деактивированный
     * @param int $operation_id
     * @return bool
     */
    public function setDeactivated(int $operation_id): bool;

    /**
     * пометить как просроченный
     * @return bool
     */
    public function setOverdue(): bool;

    /**
     * удаление модели
     * @return bool
     */
    public function deleteModel(): bool;
}
