<?php
namespace sorokinmedia\promocodes\handlers\PromoCode\actions;

/**
 * Class Update
 * @package sorokinmedia\promocodes\handlers\PromoCode\actions
 */
class Update extends AbstractAction
{
    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function execute() : bool
    {
        return $this->promo_code->updateModel();
    }
}