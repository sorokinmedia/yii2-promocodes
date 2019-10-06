<?php

namespace sorokinmedia\promocodes\tests\entities\PromoCodeLog;

use sorokinmedia\promocodes\tests\entities\PromoCode\PromoCode;
use sorokinmedia\promocodes\tests\entities\User\User;
use sorokinmedia\promocodes\tests\TestCase;
use Throwable;
use yii\base\InvalidConfigException;
use yii\db\Exception;
use yii\db\StaleObjectException;

/**
 * Class PromoCodeLogTest
 * @package sorokinmedia\promocodes\tests\entities\PromoCodeLog
 */
class PromoCodeLogTest extends TestCase
{
    /**
     * @group promo-code-log
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testFields(): void
    {
        $this->initDb();
        $log = new PromoCodeLog();
        $this->assertEquals(
            [
                'id',
                'user_id',
                'promo_code_id',
                'operation_id',
                'deactivate_operation_id',
                'status_id',
                'created_at',
                'updated_at',
                'activated_at',
                'deactivated_at'
            ],
            array_keys($log->getAttributes())
        );
    }

    /**
     * @group promo-code-log
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testRelations(): void
    {
        $this->initDb();
        $log = PromoCodeLog::findOne(1);
        $this->assertInstanceOf(PromoCodeLog::class, $log);
        $this->assertInstanceOf(User::class, $log->getUser()->one());
        $this->assertInstanceOf(PromoCode::class, $log->getPromoCode()->one());
        $this->assertEquals('Активирован, использован', $log->getStatus());
    }

    /**
     * @group promo-code-log
     */
    public function testGetStatuses(): void
    {
        $this->assertInternalType('array', PromoCodeLog::getStatuses());
        $this->assertCount(6, PromoCodeLog::getStatuses());
    }

    /**
     * @group promo-code-log
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testGetStatusLabel(): void
    {
        $this->initDb();
        $log = PromoCodeLog::findOne(1);
        $this->assertEquals('success', $log->getStatusLabel());
    }

    /**
     * @group promo-code-log
     * @throws Exception
     * @throws InvalidConfigException
     * @throws Throwable
     */
    public function testStaticCreate(): void
    {
        $this->initDb();
        $this->initDbAdditional();
        $promo_code = PromoCode::findOne(1);
        $user = User::findOne(2);
        /** @var PromoCodeLog $log */
        $log = PromoCodeLog::create($promo_code, $user);
        $this->assertInstanceOf(PromoCodeLog::class, $log);
        $this->assertEquals($user->id, $log->user_id);
        $this->assertEquals($promo_code->id, $log->promo_code_id);
        $this->assertEquals(PromoCodeLog::STATUS_WAIT, $log->status_id);
        $this->assertNull($log->operation_id);
    }

    /**
     * @group promo-code-log
     * @throws Exception
     * @throws InvalidConfigException
     * @throws Throwable
     */
    public function testStaticCreateExisted(): void
    {
        $this->initDb();
        $promo_code = PromoCode::findOne(1);
        $user = User::findOne(1);
        /** @var PromoCodeLog $log */
        $log = PromoCodeLog::create($promo_code, $user);
        $this->assertInstanceOf(PromoCodeLog::class, $log);
        $this->assertEquals($user->id, $log->user_id);
        $this->assertEquals($promo_code->id, $log->promo_code_id);
        $this->assertEquals(PromoCodeLog::STATUS_ACTIVATED, $log->status_id);
        $this->assertEquals(1, $log->operation_id);
    }

    /**
     * @group promo-code-log
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testSetActivated(): void
    {
        $this->initDb();
        $this->initDbAdditional();
        $log = PromoCodeLog::findOne(2);
        $this->assertTrue($log->setActivated(2));
        $log->refresh();
        $this->assertEquals(2, $log->operation_id);
        $this->assertEquals(PromoCodeLog::STATUS_ACTIVATED_NOT_USED, $log->status_id);
    }

    /**
     * @group promo-code-log
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testSetDeactivated(): void
    {
        $this->initDb();
        $this->initDbAdditional();
        $log = PromoCodeLog::findOne(2);
        $this->assertTrue($log->setDeactivated(2));
        $log->refresh();
        $this->assertEquals(2, $log->deactivate_operation_id);
        $this->assertEquals(PromoCodeLog::STATUS_DEACTIVATED, $log->status_id);
    }

    /**
     * @group promo-code-log
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testSetOverdue(): void
    {
        $this->initDb();
        $this->initDbAdditional();
        $log = PromoCodeLog::findOne(2);
        $this->assertTrue($log->setOverdue());
        $log->refresh();
        $this->assertEquals(PromoCodeLog::STATUS_OVERDUE, $log->status_id);
    }

    /**
     * @group promo-code-log
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     * @throws StaleObjectException
     */
    public function testDeleteModel(): void
    {
        $this->initDb();
        $log = PromoCodeLog::findOne(1);
        $log->deleteModel();
        $deleted_log = PromoCodeLog::findOne(1);
        $this->assertNull($deleted_log);
    }
}
