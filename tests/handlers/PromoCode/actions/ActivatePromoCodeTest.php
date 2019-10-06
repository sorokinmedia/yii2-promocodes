<?php

namespace sorokinmedia\promocodes\tests\handlers\PromoCode\actions;

use sorokinmedia\promocodes\handlers\PromoCode\PromoCodeHandler;
use sorokinmedia\promocodes\tests\entities\PromoCode\PromoCode;
use sorokinmedia\promocodes\tests\entities\User\User;
use sorokinmedia\promocodes\tests\TestCase;
use Throwable;
use yii\base\InvalidConfigException;
use yii\db\Exception;

/**
 * Class ActivatePromoCodeTest
 * @package sorokinmedia\promocodes\tests\handlers\PromoCode\actions
 */
class ActivatePromoCodeTest extends TestCase
{
    /**
     * @group promo-code-handler
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testAction(): void
    {
        $this->initDb();
        $this->initDbAdditional();
        $promo_code = PromoCode::findOne(2);
        $user = User::findOne(1);
        $handler = new PromoCodeHandler($promo_code);
        $this->assertEquals(0, $handler->activate($user));
    }
}
