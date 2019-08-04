<?php
namespace sorokinmedia\promocodes\exceptions;

use yii\db\Exception;

/**
 * Class RechargeNotFoundException
 * @package sorokinmedia\promocodes\exceptions
 */
class RechargeNotFoundException extends Exception
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Recharge Not Found Exception';
    }
}
