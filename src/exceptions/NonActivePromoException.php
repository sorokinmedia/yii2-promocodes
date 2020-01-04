<?php

namespace sorokinmedia\promocodes\exceptions;

use yii\db\Exception;

/**
 * Class NonActivePromoException
 * @package sorokinmedia\promocodes\exceptions
 */
class NonActivePromoException extends Exception
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Non Active PromoCode Exception';
    }
}
