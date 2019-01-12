<?php
namespace sorokinmedia\promocodes\handlers\PromoCodeCategory\actions;

/**
 * Class Update
 * @package sorokinmedia\promocodes\handlers\PromoCodeCategory\actions
 */
class Update extends AbstractAction
{
    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function execute() : bool
    {
        return $this->promo_code_category->updateModel();
    }
}