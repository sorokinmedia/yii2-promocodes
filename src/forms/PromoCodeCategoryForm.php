<?php
namespace sorokinmedia\promocodes\forms;

use sorokinmedia\promocodes\entities\PromoCodeCategory\AbstractPromoCodeCategory;
use yii\base\Model;

/**
 * Class PromoCodeCategoryForm
 * @package sorokinmedia\promocodes\forms
 *
 * @property string $name
 * @property int $parent_id
 */
class PromoCodeCategoryForm extends Model
{
    public $name;
    public $parent_id;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['parent_id'], 'integer'],
            [['parent_id'], 'default', 'value' => 0]
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'name' => \Yii::t('app', 'Название'),
            'parent_id' => \Yii::t('app', 'Родитель'),
        ];
    }

    /**
     * PromoCodeCategoryForm constructor.
     * @param array $config
     * @param AbstractPromoCodeCategory|null $promoCodeCategory
     */
    public function __construct(array $config = [], AbstractPromoCodeCategory $promoCodeCategory = null)
    {
        if ($promoCodeCategory !== null){
            $this->name = $promoCodeCategory->name;
            $this->parent_id = $promoCodeCategory->parent_id;
        }
        parent::__construct($config);
    }
}