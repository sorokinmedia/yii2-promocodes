<?php
namespace sorokinmedia\promocodes\exceptions;

use yii\db\Exception;

/**
 * Class AlreadyActivatedPromoException
 * @package sorokinmedia\promocodes\exceptions
 */
class AlreadyActivatedPromoException extends Exception
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Already Activated PromoCode Exception';
    }
}
