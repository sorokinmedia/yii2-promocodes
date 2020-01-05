<?php

namespace sorokinmedia\promocodes\exceptions;

use Exception;
use Throwable;
use Yii;

/**
 * Class PromoCodeActivationError
 * @package sorokinmedia\promocodes\exceptions
 *
 * @property int $log_id
 */
class PromoCodeActivationError extends Exception
{
    public $log_id;

    /**
     * PromoCodeActivationError constructor.
     * @param int $log_id
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(int $log_id, $message = '', $code = 0, Throwable $previous = null)
    {
        $this->log_id = $log_id;
        $message = Yii::t('app-sm-promocodes', 'Ошибка при активации промокода, лог:{log_id}, {error_message}', [
            'log_id' => $this->log_id,
            'error_message' => $message
        ]);
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Promo Code Activation Error Exception';
    }
}
