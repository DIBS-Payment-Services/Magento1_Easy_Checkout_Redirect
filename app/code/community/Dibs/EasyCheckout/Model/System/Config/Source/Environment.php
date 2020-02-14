<?php

/**
 * Class Dibs_EasyCheckout_Model_System_Config_Source_Environment
 */
class Dibs_EasyCheckout_Model_System_Config_Source_Environment
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
                'value' => Dibs_EasyCheckout_Model_Config::CONFIG_API_ENVIRONMENT_LIVE,
                'label' => $this->getModuleHelper()->__('Live')
            ),
            array(
                'value' => Dibs_EasyCheckout_Model_Config::CONFIG_API_ENVIRONMENT_TEST,
                'label' => $this->getModuleHelper()->__('Test')
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
            Dibs_EasyCheckout_Model_Config::CONFIG_API_ENVIRONMENT_LIVE => $this->getModuleHelper()->__('Live'),
            Dibs_EasyCheckout_Model_Config::CONFIG_API_ENVIRONMENT_TEST  => $this->getModuleHelper()->__('Test'),
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
