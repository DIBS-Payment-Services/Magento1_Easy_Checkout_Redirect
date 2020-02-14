<?php

/**
 * Class Dibs_EasyCheckout_Model_Api_Payment_Consumer_Address
 */
class Dibs_EasyCheckout_Model_Api_Payment_Consumer_Address extends Varien_Object
{
    /**
     * @return array
     */
    public function getStreetsArray()
    {
        $result = [
            $this->getData('addressLine1'),
            $this->getData('addressLine2')
        ];
        return $result;
    }
}
