<?php

namespace sorokinmedia\promocodes\exceptions;

use Exception;
use Throwable;
use Yii;

/**
 * Class PromoCodeSetUsedError
 * @package sorokinmedia\promocodes\exceptions
 *
 * @property int $log_id
 */
class PromoCodeSetUsedError extends Exception
{
    public $log_id;

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Promo Code Set Used Error Exception';
    }

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
        $message = Yii::t('app', 'Ошибка при пометке использованным, лог:{log_id}, {error_message}', [
            'log_id' => $this->log_id,
            'error_message' => $message
        ]);
        parent::__construct($message, $code, $previous);
    }
}
