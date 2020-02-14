<?php

/**
 * Class Dibs_EasyCheckout_Model_System_Config_Source_Status
 */
class Dibs_EasyCheckout_Model_System_Config_Source_Status
{
    protected $_stateStatuses = array(
        Mage_Sales_Model_Order::STATE_PROCESSING,
    );

    public function toOptionArray()
    {
        if ($this->_stateStatuses) {
            $statuses = Mage::getSingleton('sales/order_config')->getStateStatuses($this->_stateStatuses);
        } else {
            $statuses = Mage::getSingleton('sales/order_config')->getStatuses();
        }

        $options = array(
            array(
                'value' => '',
                'label' => Mage::helper('adminhtml')->__('-- Please Select --')
            )
        );

        foreach ($statuses as $code => $label) {
            $options[] = array(
                'value' => $code,
                'label' => $label
            );
        }
        return $options;
    }
}