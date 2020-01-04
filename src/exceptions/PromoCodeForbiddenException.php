<?php

namespace sorokinmedia\promocodes\exceptions;

use yii\db\Exception;

/**
 * Class PromoCodeForbiddenException
 * @package sorokinmedia\promocodes\exceptions
 */
class PromoCodeForbiddenException extends Exception
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'PromoCode Forbidden Exception';
    }
}
