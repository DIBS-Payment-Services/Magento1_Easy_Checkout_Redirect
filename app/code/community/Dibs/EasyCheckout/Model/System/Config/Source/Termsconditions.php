<?php

/**
 * Class Dibs_EasyCheckout_Model_System_Config_Source_Termsconditions
 */
class Dibs_EasyCheckout_Model_System_Config_Source_Termsconditions
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
                'value' => Dibs_EasyCheckout_Model_Config::CONFIG_TERMS_CONDITIONS_LINK_TYPE_DIRECT,
                'label' => $this->getModuleHelper()->__('Direct Link')
            ),
            array(
                'value' => Dibs_EasyCheckout_Model_Config::CONFIG_TERMS_CONDITIONS_LINK_TYPE_CMS_PAGE,
                'label' => $this->getModuleHelper()->__('Cms Page')
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
            Dibs_EasyCheckout_Model_Config::CONFIG_TERMS_CONDITIONS_LINK_TYPE_DIRECT =>
                $this->getModuleHelper()->__('Direct Link'),
            Dibs_EasyCheckout_Model_Config::CONFIG_TERMS_CONDITIONS_LINK_TYPE_CMS_PAGE  =>
                $this->getModuleHelper()->__('Cms Page'),
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
