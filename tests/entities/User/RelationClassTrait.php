<?php

namespace sorokinmedia\promocodes\tests\entities\User;

use sorokinmedia\promocodes\tests\entities\{PromoCode\PromoCode,
    PromoCodeCategory\PromoCodeCategory,
    PromoCodeLog\PromoCodeLog,
    UserAccessToken\UserAccessToken,
    UserMeta\UserMeta
};

/**
 * Trait RelationClassTrait
 * @package sorokinmedia\promocodes\tests\entities\User
 */
trait RelationClassTrait
{
    public $__userClass;
    public $__userMetaClass;
    public $__userAccessTokenClass;
    public $__promoCodeClass;
    public $__promoCodeCategoryClass;
    public $__promoCodeLogClass;

    /**
     * инициализация связей
     */
    public function init(): void
    {
        parent::init();
        $this->initClasses();
    }

    public function initClasses(): void
    {
        $this->__userClass = User::class;
        $this->__userMetaClass = UserMeta::class;
        $this->__userAccessTokenClass = UserAccessToken::class;
        $this->__promoCodeClass = PromoCode::class;
        $this->__promoCodeCategoryClass = PromoCodeCategory::class;
        $this->__promoCodeLogClass = PromoCodeLog::class;
    }

    /**
     * метод для динамической подстановки нужного класса в связь
     * @param string $field
     * @param string $class
     * @return mixed
     */
    public function setRelationClass(string $field, string $class)
    {
        return $this->{$field} = $class;
    }
}
