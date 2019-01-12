<?php

namespace sorokinmedia\promocodes\tests\entities\PromoCodeLog;

use sorokinmedia\promocodes\tests\entities\PromoCode\PromoCode;
use sorokinmedia\promocodes\tests\entities\User\User;
use sorokinmedia\promocodes\tests\TestCase;

/**
 * Class PromoCodeLogTest
 * @package sorokinmedia\promocodes\tests\entities\PromoCodeLog
 */
class PromoCodeLogTest extends TestCase
{
    /**
     * @group promo-code-log
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testFields()
    {
        $this->initDb();
        $log = new PromoCodeLog();
        $this->assertEquals(
            [
                'id',
                'user_id',
                'promo_code_id',
                'operation_id',
                'status_id',
                'created_at',
                'updated_at'
            ],
            array_keys($log->getAttributes())
        );
    }

    /**
     * @group promo-code-log
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testRelations()
    {
        $this->initDb();
        $log = PromoCodeLog::findOne(1);
        $this->assertInstanceOf(PromoCodeLog::class, $log);
        $this->assertInstanceOf(User::class, $log->getUser()->one());
        $this->assertInstanceOf(PromoCode::class, $log->getPromoCode()->one());
        $this->assertEquals('Активирован', $log->getStatus());
    }

    /**
     * @group promo-code-log
     */
    public function testGetStatuses()
    {
        $this->assertInternalType('array', PromoCodeLog::getStatuses());
        $this->assertCount(4, PromoCodeLog::getStatuses());
    }

    /**
     * @group promo-code-log
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testGetStatusLabel()
    {
        $this->initDb();
        $log = PromoCodeLog::findOne(1);
        $this->assertEquals('success', $log->getStatusLabel());
    }

    /**
     * @group promo-code-log
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testStaticCreate()
    {
        $this->initDb();
        $promo_code = PromoCode::findOne(1);
        $user = User::findOne(1);
        $log = PromoCodeLog::create($promo_code, $user, PromoCodeLog::STATUS_WAIT);
        $this->assertInstanceOf(PromoCodeLog::class, $log);
        $this->assertEquals($user->id, $log->user_id);
        $this->assertEquals($promo_code->id, $log->promo_code_id);
        $this->assertEquals(PromoCodeLog::STATUS_WAIT, $log->status_id);
        $this->assertNull($log->operation_id);
    }

    /**
     * @group promo-code-log
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testStaticCreateExisted()
    {
        $this->initDb();
        $promo_code = PromoCode::findOne(1);
        $user = User::findOne(1);
        $log = PromoCodeLog::create($promo_code, $user, PromoCodeLog::STATUS_ACTIVATE);
        $this->assertInstanceOf(PromoCodeLog::class, $log);
        $this->assertEquals($user->id, $log->user_id);
        $this->assertEquals($promo_code->id, $log->promo_code_id);
        $this->assertEquals(PromoCodeLog::STATUS_ACTIVATE, $log->status_id);
        $this->assertEquals(1, $log->operation_id);
    }

    /**
     * @group promo-code-log
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testActivate()
    {
        $this->initDb();
        $this->initDbAdditional();
        $log = PromoCodeLog::findOne(2);
        $this->assertTrue($log->activate(2));
        $log->refresh();
        $this->assertEquals(2, $log->operation_id);
        $this->assertEquals(PromoCodeLog::STATUS_ACTIVATE, $log->status_id);
    }

    /**
     * @group promo-code-log
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testOverdue()
    {
        $this->initDb();
        $this->initDbAdditional();
        $log = PromoCodeLog::findOne(2);
        $this->assertTrue($log->overdue());
        $log->refresh();
        $this->assertEquals(PromoCodeLog::STATUS_OVERDUE, $log->status_id);
    }
}