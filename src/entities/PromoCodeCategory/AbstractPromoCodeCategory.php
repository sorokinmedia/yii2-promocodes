<?php

namespace sorokinmedia\promocodes\entities\PromoCodeCategory;

use sorokinmedia\promocodes\forms\PromoCodeCategoryForm;
use yii\db\{ActiveQuery, ActiveRecord, Exception};
use sorokinmedia\ar_relations\RelationInterface;

/**
 * This is the model class for table "promo_code_cat".
 *
 * @property int $id
 * @property string $name
 * @property int $parent_id
 * @property int $has_child
 *
 * @property PromoCodeCategoryForm $form
 */
abstract class AbstractPromoCodeCategory extends ActiveRecord implements RelationInterface, PromoCodeCategoryInterface
{
    public $form;

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'promo_code_category';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['parent_id', 'has_child'], 'integer'],
            [['has_child'], 'default', 'value' => 0]
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => \Yii::t('app', 'ID'),
            'name' => \Yii::t('app', 'Название'),
            'parent_id' => \Yii::t('app', 'Родитель'),
            'has_child' => \Yii::t('app', 'Есть дочерние'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getPromoCodes(): ActiveQuery
    {
        return $this->hasMany($this->__promoCodeClass, ['cat_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getParent(): ActiveQuery
    {
        return $this->hasOne($this->__promoCodeCategoryClass, ['id' => 'parent_id']);
    }

    /**
     * AbstractPromoCodeCategory constructor.
     * @param array $config
     * @param PromoCodeCategoryForm|null $form
     */
    public function __construct(array $config = [], PromoCodeCategoryForm $form = null)
    {
        if($form !== null){
            $this->form = $form;
        }
        parent::__construct($config);
    }

    /**
     * трансфер данных из формы в модель
     */
    public function getFromForm()
    {
        if ($this->form !== null){
            $this->name = $this->form->name;
            $this->parent_id = $this->form->parent_id;
        }
    }

    /**
     * @return bool
     * @throws Exception
     * @throws \Throwable
     */
    public function insertModel() : bool
    {
        $this->getFromForm();
        if (!$this->insert()){
            throw new Exception(\Yii::t('app', 'Ошибка при добавлении в БД'));
        }
        return true;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function updateModel() : bool
    {
        $this->getFromForm();
        if (!$this->save()){
            throw new Exception(\Yii::t('app', 'Ошибка при обновлении в БД'));
        }
        return true;
    }

    /**
     * @return bool
     * @throws Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function deleteModel() : bool
    {
        //todo: удаление связанных сущностей и упоминаний
        if (!$this->delete()){
            throw new Exception(\Yii::t('app', 'Ошибка при удалении из БД'));
        }
        return true;
    }

    /**
     * статический конструктор
     * @param string $name
     * @param int|null $parent_id
     * @return AbstractPromoCodeCategory
     * @throws Exception
     */
    public static function create(string $name, int $parent_id = null) : self
    {
        $promo_category = static::findOne(['name' => $name]);
        if ($promo_category instanceof self){
            return $promo_category;
        }
        $promo_category = new static([
            'name' => $name,
            'parent_id' => $parent_id,
        ]);
        if (!$promo_category->insert()){
            throw new Exception(\Yii::t('app', 'Ошибка при добавлении в БД'));
        }
        return $promo_category;
    }
}
