<?php

/**
 * Class Dibs_EasyCheckout_Model_System_Config_Source_Customertype
 */
class Dibs_EasyCheckout_Model_System_Config_Source_Customertype
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array(
                'value' => Dibs_EasyCheckout_Model_Config::CONFIG_CUSTOMER_TYPE_B2C,
                'label' => $this->getModuleHelper()->__('(B2C) Only')
            ),
            array(
                'value' => Dibs_EasyCheckout_Model_Config::CONFIG_CUSTOMER_TYPE_B2B,
                'label' => $this->getModuleHelper()->__('(B2B) Only')
            ),
            array(
                'value' => Dibs_EasyCheckout_Model_Config::CONFIG_CUSTOMER_TYPE_ALL_B2C_DEFAULT,
                'label' => $this->getModuleHelper()->__('(B2C & B2B) Defaults to B2C')
            ),
            array(
                'value' => Dibs_EasyCheckout_Model_Config::CONFIG_CUSTOMER_TYPE_ALL_B2B_DEFAULT,
                'label' => $this->getModuleHelper()->__('(B2B & B2C) Defaults to B2B')
            )
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            Dibs_EasyCheckout_Model_Config::CONFIG_CUSTOMER_TYPE_B2C =>
                $this->getModuleHelper()->__('Direct Link'),
            Dibs_EasyCheckout_Model_Config::CONFIG_CUSTOMER_TYPE_B2B  =>
                $this->getModuleHelper()->__('Cms Page'),
            Dibs_EasyCheckout_Model_Config::CONFIG_CUSTOMER_TYPE_ALL_B2C_DEFAULT =>
                $this->getModuleHelper()->__('(B2C && B2B) Defaults to B2C'),
            Dibs_EasyCheckout_Model_Config::CONFIG_CUSTOMER_TYPE_ALL_B2B_DEFAULT  =>
                $this->getModuleHelper()->__('(B2B && B2C) Defaults to B2B')
        );
    }

    /**
     * @return Mage_Core_Helper_Abstract
     */
    public function getModuleHelper()
    {
        $helper = Mage::helper('dibs_easycheckout');
        return $helper;
    }

}
