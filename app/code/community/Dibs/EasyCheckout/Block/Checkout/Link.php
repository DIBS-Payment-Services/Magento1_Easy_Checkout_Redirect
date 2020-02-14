<?php

/**
 * Class Dibs_EasyCheckout_Block_Checkout_Link
 */
class Dibs_EasyCheckout_Block_Checkout_Link extends Mage_Core_Block_Template
{
    /**
     * @return string
     */
    public function getCheckoutUrl()
    {
        return $this->getUrl('dibseasy/checkout');
    }

    /**
     * @return mixed
     */
    public function isEasyCheckoutAvailable()
    {
        return $this->getDibsHelper()->isEasyCheckoutAvailable();
    }

    /**
     * @return Dibs_EasyCheckout_Helper_Data
     */
    protected function getDibsHelper()
    {
        return $this->helper('dibs_easycheckout');
    }
}
