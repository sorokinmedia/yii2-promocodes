<?php
namespace sorokinmedia\promocodes\exceptions;

use yii\db\Exception;

/**
 * Class NewUsersPromoException
 * @package sorokinmedia\promocodes\exceptions
 */
class NewUsersPromoException extends Exception
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'New Users PromoCode Only Exception';
    }
}
