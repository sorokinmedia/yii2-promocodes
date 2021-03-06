<?php

namespace sorokinmedia\promocodes\entities\PromoCode;

use sorokinmedia\ar_relations\RelationInterface;
use sorokinmedia\promocodes\forms\PromoCodeForm;
use Throwable;
use Yii;
use yii\db\{ActiveQuery, ActiveRecord, Exception};
use yii\web\IdentityInterface;

/**
 * Class AbstractPromoCode
 * @package sorokinmedia\promocodes\entities\PromoCode
 *
 * @property int $id
 * @property string $value
 * @property string $title
 * @property string $description
 * @property int $cat_id
 * @property int $type_id
 * @property int $creator_id
 * @property int $beneficiary_id
 * @property int $date_from
 * @property int $date_to
 * @property double $sum_promo
 * @property double $sum_recharge
 * @property double $discount_fixed
 * @property int $discount_percentage
 * @property int $is_available_old
 * @property int $is_deleted
 *
 * @property PromoCodeForm $form
 */
abstract class AbstractPromoCode extends ActiveRecord implements RelationInterface, PromoCodeInterface
{
    public const TYPE_AFTER_RECHARGE = 1;
    public const TYPE_PRODUCT_DISCOUNT_FIXED = 2;
    public const TYPE_PRODUCT_DISCOUNT_PERCENTAGE = 3;
    public $form;

    /**
     * AbstractPromoCode constructor.
     * @param array $config
     * @param PromoCodeForm|null $form
     */
    public function __construct(array $config = [], PromoCodeForm $form = null)
    {
        if ($form !== null) {
            $this->form = $form;
        }
        parent::__construct($config);
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'promo_code';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['value', 'date_from', 'date_to', 'cat_id', 'type_id'], 'required'],
            [['cat_id', 'type_id', 'creator_id', 'beneficiary_id', 'date_from', 'date_to', 'discount_percentage', 'is_available_old', 'is_deleted'], 'integer'],
            [['sum_promo', 'sum_recharge', 'discount_fixed'], 'number'],
            [['value', 'title', 'description'], 'string', 'max' => 255],
            [['value'], 'match', 'pattern' => '/^[a-z_0-9]+$/'],
            [['is_available_old', 'is_deleted'], 'default', 'value' => 0],
            [['date_from'], 'default', 'value' => time()],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app-sm-promocodes', 'ID'),
            'value' => Yii::t('app-sm-promocodes', 'Промокод'),
            'title' => Yii::t('app-sm-promocodes', 'Название'),
            'description' => Yii::t('app-sm-promocodes', 'Описание'),
            'cat_id' => Yii::t('app-sm-promocodes', 'Категория'),
            'type_id' => Yii::t('app-sm-promocodes', 'Тип'),
            'creator_id' => Yii::t('app-sm-promocodes', 'Добавил'),
            'beneficiary_id' => Yii::t('app-sm-promocodes', 'Бенефициар'),
            'date_from' => Yii::t('app-sm-promocodes', 'Начало действия'),
            'date_to' => Yii::t('app-sm-promocodes', 'Окончание действия'),
            'sum_promo' => Yii::t('app-sm-promocodes', 'Сумма промо'),
            'sum_recharge' => Yii::t('app-sm-promocodes', 'Сумма для активации'),
            'discount_fixed' => Yii::t('app-sm-promocodes', 'Скидка в рублях'),
            'discount_percentage' => Yii::t('app-sm-promocodes', 'Скидка в %'),
            'is_available_old' => Yii::t('app-sm-promocodes', 'Доступен для старых пользователей'),
            'is_deleted' => Yii::t('app-sm-promocodes', 'Удален'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getCategory(): ActiveQuery
    {
        return $this->hasOne($this->__promoCodeCategoryClass, ['id' => 'cat_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCreator(): ActiveQuery
    {
        return $this->hasOne($this->__userClass, ['id' => 'creator_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getBeneficiary(): ActiveQuery
    {
        return $this->hasOne($this->__userClass, ['id' => 'beneficiary_id']);
    }

    /**
     * //todo: need test with billing extension
     * @return ActiveQuery
     */
    public function getOperations(): ActiveQuery
    {
        return $this->hasMany($this->__operationClass, ['comment' => 'title'])
            ->andFilterWhere(['type_id' => $this->__operationClass::BILL_IN_PROMOCODE])
            ->orderBy(['id' => SORT_DESC]);
    }

    /**
     * @return bool
     * @throws Exception
     * @throws Throwable
     */
    public function insertModel(): bool
    {
        $this->getFromForm();
        if (!$this->insert()) {
            throw new Exception(Yii::t('app-sm-promocodes', 'Ошибка при добавлении в БД'));
        }
        return true;
    }

    /**
     * переносит данные из формы в модель
     */
    public function getFromForm(): void
    {
        $this->value = $this->form->value;
        $this->title = $this->form->title;
        $this->description = $this->form->description;
        $this->cat_id = $this->form->cat_id;
        $this->type_id = $this->form->type_id;
        $this->creator_id = $this->form->creator_id;
        $this->beneficiary_id = $this->form->beneficiary_id;
        $this->date_from = $this->form->date_from;
        $this->date_to = $this->form->date_to;
        $this->sum_promo = $this->form->sum_promo;
        $this->sum_recharge = $this->form->sum_recharge;
        $this->discount_fixed = $this->form->discount_fixed;
        $this->discount_percentage = $this->form->discount_percentage;
        $this->is_available_old = $this->form->is_available_old;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function updateModel(): bool
    {
        $this->getFromForm();
        if (!$this->save()) {
            throw new Exception(Yii::t('app-sm-promocodes', 'Ошибка при обновлении в БД'));
        }
        return true;
    }

    /**
     * @return bool
     * @throws \Exception
     * @throws Throwable
     */
    public function deleteModel(): bool
    {
        $this->is_deleted = 1;
        if (!$this->save()) {
            throw new Exception(Yii::t('app-sm-promocodes', 'Ошибка при удалении из БД'));
        }
        return true;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        $time = time();
        return ($this->date_from < $time && $this->date_to > $time);
    }

    /**
     * @return bool
     */
    public function isAvailableForOld(): bool
    {
        return $this->is_available_old === 1;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->is_deleted === 1;
    }

    /**
     * необходима реализация метода на проекте
     * @param IdentityInterface $user
     * @return bool
     */
    abstract public function checkCode(IdentityInterface $user): bool;

    /**
     * необходима реализация метода на проекте
     * @param IdentityInterface $user
     * @return int
     */
    abstract public function afterRechargePayment(IdentityInterface $user): int;

    /**
     * необходима реализация метода на проекте
     * @param IdentityInterface $user
     * @return bool
     */
    abstract public function afterRechargeBeneficiary(IdentityInterface $user): bool;

    /**
     * уведомление после активации
     * @param IdentityInterface $user
     * @return bool
     */
    abstract public function notifyAfterActivation(IdentityInterface $user): bool;

    /**
     * необходима реализация метода на проекте
     * @param IdentityInterface $user
     * @return bool
     */
    abstract public function afterDeactivationBeneficiary(IdentityInterface $user): bool;

    /**
     * необходима реализация метода на проекте
     * @param IdentityInterface $user
     * @return int
     */
    abstract public function afterDeactivationOperation(IdentityInterface $user): int;
}
