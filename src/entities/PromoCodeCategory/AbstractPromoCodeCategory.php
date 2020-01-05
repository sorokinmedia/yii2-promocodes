<?php

namespace sorokinmedia\promocodes\entities\PromoCodeCategory;

use sorokinmedia\ar_relations\RelationInterface;
use sorokinmedia\promocodes\forms\PromoCodeCategoryForm;
use sorokinmedia\treeview\TreeViewModelStaticInterface;
use Throwable;
use Yii;
use yii\db\{ActiveQuery, ActiveRecord, Exception};

/**
 * This is the model class for table "promo_code_cat".
 *
 * @property int $id
 * @property string $name
 * @property int $parent_id
 * @property int $has_child
 * @property int $is_deleted
 *
 * @property PromoCodeCategoryForm $form
 * @property int|string $level
 */
abstract class AbstractPromoCodeCategory extends ActiveRecord implements RelationInterface, PromoCodeCategoryInterface, TreeViewModelStaticInterface
{
    public $form;
    public $level;

    /**
     * AbstractPromoCodeCategory constructor.
     * @param array $config
     * @param PromoCodeCategoryForm|null $form
     */
    public function __construct(array $config = [], PromoCodeCategoryForm $form = null)
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
        return 'promo_code_category';
    }

    /**
     * статический конструктор
     * @param string $name
     * @param int|null $parent_id
     * @return PromoCodeCategoryInterface
     * @throws Exception
     * @throws Throwable
     */
    public static function create(string $name, int $parent_id = 0): PromoCodeCategoryInterface
    {
        $promo_category = static::findOne(['name' => $name]);
        if ($promo_category instanceof self) {
            return $promo_category;
        }
        $promo_category = new static([
            'name' => $name,
            'parent_id' => $parent_id,
            'has_child' => 0
        ]);
        if (!$promo_category->insert()) {
            throw new Exception(Yii::t('app-sm-promocodes', 'Ошибка при добавлении в БД'));
        }
        $promo_category->updateParent();
        return $promo_category;
    }

    /**
     * апдейт родительского элемента
     * @param int|null $old_parent_id
     * @return bool
     * @throws Exception
     */
    public function updateParent(int $old_parent_id = null): bool
    {
        if ($this->parent_id !== null && $this->parent_id > 0 && $this->parent_id !== '') {
            return $this->parent->hasChildUpdate(1);
        }
        if ($old_parent_id !== null) {
            $child_count = self::find()->where(['parent_id' => $old_parent_id])->count();
            if ($child_count === 0) {
                $parent = static::findOne($old_parent_id);
                if ($parent !== null) {
                    return $parent->hasChildUpdate(0);
                }
            }
        }
        return true;
    }

    /**
     * апдейт параметра has_child
     * @param int $has_child
     * @return bool
     * @throws Exception
     */
    public function hasChildUpdate(int $has_child): bool
    {
        $this->has_child = $has_child;
        if (!$this->save()) {
            throw new Exception(Yii::t('app-sm-promocodes', 'Ошибка при обновлении родителя'));
        }
        return true;
    }

    /**
     * список родитилей
     * @return array
     */
    public static function getParentsArray(): array
    {
        return static::find()
            ->select([
                'name', 'id'
            ])
            ->where(['parent_id' => 0])
            ->andWhere(['is_deleted' => 0])
            ->indexBy('id')
            ->orderBy(['name' => SORT_ASC])
            ->column();
    }

    /**
     * @param int $parent_id
     * @param null $filter
     * @return array|ActiveRecord[]
     */
    public static function getChildModelsStatic(int $parent_id, $filter = null): array
    {
        return static::find()
            ->where(['parent_id' => $parent_id])
            ->andWhere(['is_deleted' => 0])
            ->orderBy(['name' => SORT_ASC])
            ->all();
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['parent_id', 'has_child', 'is_deleted'], 'integer'],
            [['parent_id', 'has_child', 'is_deleted'], 'default', 'value' => 0],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app-sm-promocodes', 'ID'),
            'name' => Yii::t('app-sm-promocodes', 'Название'),
            'parent_id' => Yii::t('app-sm-promocodes', 'Родитель'),
            'has_child' => Yii::t('app-sm-promocodes', 'Есть дочерние'),
            'is_deleted' => Yii::t('app-sm-promocodes', 'Удален'),
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
    public function getNotDeletedPromoCodes(): ActiveQuery
    {
        return $this->hasMany($this->__promoCodeClass, ['cat_id' => 'id'])->andFilterWhere(['is_deleted' => 0]);
    }

    /**
     * @return ActiveQuery
     */
    public function getParent(): ActiveQuery
    {
        return $this->hasOne($this->__promoCodeCategoryClass, ['id' => 'parent_id']);
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
        $this->updateParent();
        return true;
    }

    /**
     * трансфер данных из формы в модель
     */
    public function getFromForm(): void
    {
        if ($this->form !== null) {
            $this->name = $this->form->name;
            $this->parent_id = $this->form->parent_id;
            $this->has_child = 0;
        }
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function updateModel(): bool
    {
        $old_parent_id = $this->parent_id;
        $this->getFromForm();
        if (!$this->save()) {
            throw new Exception(Yii::t('app-sm-promocodes', 'Ошибка при обновлении в БД'));
        }
        $this->updateParent($old_parent_id);
        return true;
    }

    /**
     * @return bool
     * @throws Exception
     * @throws Throwable
     */
    public function deleteModel(): bool
    {
        $this->is_deleted = 1;
        if (!$this->save()) {
            throw new Exception(Yii::t('app-sm-promocodes', 'Ошибка при удалении из БД'));
        }
        $this->updateParent();
        return true;
    }
}
