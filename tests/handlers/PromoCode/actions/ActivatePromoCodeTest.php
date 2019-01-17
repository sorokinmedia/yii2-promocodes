<?php

namespace sorokinmedia\promocodes\tests\handlers\PromoCode\actions;

use sorokinmedia\promocodes\handlers\PromoCode\PromoCodeHandler;
use sorokinmedia\promocodes\tests\entities\PromoCode\PromoCode;
use sorokinmedia\promocodes\tests\entities\User\User;
use sorokinmedia\promocodes\tests\TestCase;

/**
 * Class ActivatePromoCodeTest
 * @package sorokinmedia\promocodes\tests\handlers\PromoCode\actions
 */
class ActivatePromoCodeTest extends TestCase
{
    /**
     * @group promo-code-handler
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testAction()
    {
        $this->initDb();
        $this->initDbAdditional();
        $promo_code = PromoCode::findOne(2);
        $user = User::findOne(1);
        $handler = new PromoCodeHandler($promo_code);
        $this->assertEquals(0, $handler->activate($user));

    }
}