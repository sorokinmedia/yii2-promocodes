<?php

namespace sorokinmedia\promocodes\exceptions;

use yii\db\Exception;

/**
 * Class PromoCodeLogExistException
 * @package sorokinmedia\promocodes\exceptions
 */
class PromoCodeLogExistException extends Exception
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'PromoCodeLog Exist Exception';
    }
}
