<?php

/**
 * Class Dibs_EasyCheckout_Model_System_Config_Source_Carrier
 */
class Dibs_EasyCheckout_Model_System_Config_Source_Carrier
{

    public function toOptionArray()
    {
        $options = [
            [
                'value' => 'dibs_easy_free_shipping',
                'label' => Mage::getStoreConfig('carriers/dibs_easy_free_shipping/title')
            ],
        ];

        $flatRateActive = $this->_isFlatrateActive();

        if ($flatRateActive) {
            $options[] = [
                'value' => 'flatrate',
                'label' => Mage::getStoreConfig('carriers/flatrate/title')
            ];
        }

        return $options;
    }

    /**
     * @return bool
     */
    protected function _isFlatrateActive()
    {
        $active = Mage::getStoreConfig('carriers/flatrate/active');
        return $active==1 || $active=='true';
    }

}