<?php
namespace sorokinmedia\promocodes\entities\PromoCode;

/**
 * Class PromoCodeFilter
 * @package sorokinmedia\promocodes\entities\PromoCode
 *
 * @property string $order
 * @property string $order_by
 */
class PromoCodeFilter
{
    public $order;
    public $order_by;

    /**
     * @param string $order
     * @param string $order_by
     * @return PromoCodeFilter
     */
    public function addInFilter(string $order = '', string $order_by = '') : self
    {
        if ($order_by !== ''){
            $this->order_by = $order_by;
        }
        if ($order !== ''){
            $this->order = $order;
        }
        return $this;
    }
}