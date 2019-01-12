<?php
namespace sorokinmedia\promocodes\forms;

use sorokinmedia\promocodes\entities\PromoCode\AbstractPromoCode;
use yii\base\Model;

/**
 * Class PromoCodeForm
 * @package sorokinmedia\promocodes\forms
 *
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
 * @property int $discount_fixed
 * @property int $discount_percentage
 * @property int $is_available_old
 */
class PromoCodeForm extends Model
{
    public $value;
    public $title;
    public $description;
    public $cat_id;
    public $type_id;
    public $creator_id;
    public $beneficiary_id;
    public $date_from;
    public $date_to;
    public $sum_promo;
    public $sum_recharge;
    public $discount_fixed;
    public $discount_percentage;
    public $is_available_old;

    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            [['value', 'date_from', 'date_to', 'cat_id', 'type_id'], 'required'],
            [['cat_id', 'type_id', 'creator_id', 'beneficiary_id', 'date_from', 'date_to', 'discount_percentage', 'is_available_old'], 'integer'],
            [['sum_promo', 'sum_recharge', 'discount_fixed'], 'number'],
            [['value', 'title', 'description'], 'string', 'max' => 255],
            [['value'], 'match', 'pattern' => '/^[a-z_0-9]+$/'],
            [['is_available_old'], 'default', 'value' => 0],
            [['date_from'], 'default', 'value' => time()],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels() : array
    {
        return [
            'value' => \Yii::t('app', 'Промокод'),
            'title' => \Yii::t('app', 'Название'),
            'description' => \Yii::t('app', 'Описание'),
            'cat_id' => \Yii::t('app', 'Категория'),
            'type_id' => \Yii::t('app', 'Тип'),
            'creator_id' => \Yii::t('app', 'Добавил'),
            'beneficiary_id' => \Yii::t('app', 'Бенефициар'),
            'date_from' => \Yii::t('app', 'Начало действия'),
            'date_to' => \Yii::t('app', 'Окончание действия'),
            'sum_promo' => \Yii::t('app', 'Сумма промо'),
            'sum_recharge' => \Yii::t('app', 'Сумма для активации'),
            'discount_fixed' => \Yii::t('app', 'Скидка в рублях'),
            'discount_percentage' => \Yii::t('app', 'Скидка в %'),
            'is_available_old' => \Yii::t('app', 'Доступен для старых пользователей'),
        ];
    }

    /**
     * PromoCodeForm constructor.
     * @param array $config
     * @param AbstractPromoCode|null $promoCode
     */
    public function __construct(array $config = [], AbstractPromoCode $promoCode = null)
    {
        if ($promoCode !== null){
            $this->value = mb_strtolower($promoCode->value);
            $this->title = $promoCode->title;
            $this->description = $promoCode->description;
            $this->cat_id = $promoCode->cat_id;
            $this->type_id = $promoCode->type_id;
            $this->creator_id = $promoCode->creator_id;
            $this->beneficiary_id = $promoCode->beneficiary_id;
            $this->date_from = $promoCode->date_from ? $promoCode->date_from : time();
            $this->date_to = $promoCode->date_to;
            $this->sum_promo = $promoCode->sum_promo;
            $this->sum_recharge = $promoCode->sum_recharge;
            $this->discount_fixed = $promoCode->discount_fixed;
            $this->discount_percentage = $promoCode->discount_percentage;
            $this->is_available_old = $promoCode->is_available_old;
        }
        parent::__construct($config);
    }
}