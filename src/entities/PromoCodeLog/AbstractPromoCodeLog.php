<?php

namespace sorokinmedia\promocodes\entities\PromoCodeLog;

use sorokinmedia\ar_relations\RelationInterface;
use sorokinmedia\promocodes\entities\PromoCode\AbstractPromoCode;
use sorokinmedia\promocodes\tests\entities\PromoCode\PromoCode;
use sorokinmedia\user\entities\User\AbstractUser;
use yii\behaviors\TimestampBehavior;
use yii\db\{ActiveQuery, ActiveRecord, Exception};
use yii\web\IdentityInterface;

/**
 * This is the model class for table "promo_code_user".
 *
 * @property int $id
 * @property int $user_id
 * @property int $promo_code_id
 * @property int $operation_id
 * @property int $status_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property PromoCode $promoCode
 */
abstract class AbstractPromoCodeLog extends ActiveRecord implements RelationInterface, PromoCodeLogInterface
{
    const STATUS_ACTIVATE = 1;
    const STATUS_WAIT = 2;
    const STATUS_OVERDUE = 3;
    const STATUS_ERROR = 4;

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'promo_code_log';
    }

    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            [['promo_code_id', 'operation_id', 'status_id', 'user_id'], 'integer'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels() : array
    {
        return [
            'id' => \Yii::t('app', 'ID'),
            'user_id' => \Yii::t('app', 'Пользователь'),
            'code_id' => \Yii::t('app', 'Промокод'),
            'operation_id' => \Yii::t('app', 'Операция'),
            'status_id' => \Yii::t('app', 'Статус'),
            'created_at' => \Yii::t('app', 'Создан'),
            'updated_at' => \Yii::t('app', 'Обновлен'),
        ];
    }

    /**
     * @return array
     */
    public function behaviors() : array
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne($this->__userClass, ['id' => 'user_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getPromoCode(): ActiveQuery
    {
        return $this->hasOne($this->__promoCodeClass, ['id' => 'promo_code_id']);
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return self::getStatuses($this->status_id);
    }

    /**
     * @param int|null $status_id
     * @return array|mixed
     */
    public static function getStatuses(int $status_id = null)
    {
        $statuses = [
            self::STATUS_ACTIVATE => \Yii::t('app', 'Активирован'),
            self::STATUS_WAIT => \Yii::t('app', 'В ожидании'),
            self::STATUS_OVERDUE => \Yii::t('app', 'Просрочен'),
            self::STATUS_ERROR => \Yii::t('app', 'Ошибка'),
        ];
        if ($status_id !== null) {
            return $statuses[$status_id];
        }
        return $statuses;
    }

    /**
     * @return string
     */
    public function getStatusLabel(): string
    {
        if ($this->status_id === self::STATUS_WAIT) {
            return 'warning';
        }
        if ($this->status_id === self::STATUS_ACTIVATE) {
            return 'success';
        }
        return 'danger';
    }

    /**
     * @param AbstractPromoCode $promoCode
     * @param IdentityInterface $user
     * @return AbstractPromoCodeLog
     * @throws Exception
     */
    public static function create(AbstractPromoCode $promoCode, IdentityInterface $user): AbstractPromoCodeLog
    {
        /** @var AbstractUser $user */
        $promo_code_log = static::findOne(['promo_code_id' => $promoCode->id, 'user_id' => $user->id]);
        if ($promo_code_log instanceof self) {
            return $promo_code_log;
        }
        $promo_code_log = new static([
            'user_id' => $user->id,
            'promo_code_id' => $promoCode->id,
        ]);
        if (!$promo_code_log->insert()) {
            throw new Exception(\Yii::t('app', 'Ошибка при добавления лога в БД'));
        }
        return $promo_code_log;
    }

    /**
     * активация промокода
     * @param int $operation_id
     * @return bool
     * @throws Exception
     */
    public function setActivated(int $operation_id): bool
    {
        $this->status_id = self::STATUS_ACTIVATE;
        $this->operation_id = $operation_id;
        if (!$this->save()) {
            throw new Exception(\Yii::t('app', 'Ошибка при активации промокода'));
        }
        return true;
    }

    /**
     * просрочка промокода
     * @return bool
     * @throws Exception
     */
    public function setOverdue(): bool
    {
        $this->status_id = self::STATUS_OVERDUE;
        if (!$this->save()) {
            throw new Exception(\Yii::t('app', 'Ошибка при просрочке промокода'));
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
        if (!$this->delete()){
            throw new Exception(\Yii::t('app', 'Ошибка при удалении из БД'));
        }
        return true;
    }
}