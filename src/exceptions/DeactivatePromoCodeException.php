<?php
namespace sorokinmedia\promocodes\exceptions;

use yii\db\Exception;

/**
 * Class DeactivatePromoCodeException
 * @package sorokinmedia\promocodes\exceptions
 */
class DeactivatePromoCodeException extends Exception
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Deactivate PromoCode Exception';
    }
}
