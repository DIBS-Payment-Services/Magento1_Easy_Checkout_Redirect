<?php


class Dibs_EasyCheckout_Block_Checkout_Form extends Mage_Payment_Block_Form
{
    protected function _construct() {
        parent::_construct();
        $this->setTemplate('dibs/easycheckout/form.phtml');
    }

    public function getLogoImg() {
        return 1245;
    }
}