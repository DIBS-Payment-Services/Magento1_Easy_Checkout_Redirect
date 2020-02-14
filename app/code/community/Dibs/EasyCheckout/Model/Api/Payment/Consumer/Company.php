<?php

/**
 * Class Dibs_EasyCheckout_Model_Api_Payment_Consumer_Company
 */
class Dibs_EasyCheckout_Model_Api_Payment_Consumer_Company extends Varien_Object
{
    /**
     * @return mixed|null
     */
    public function getTelephone()
    {
        $result = null;
        $phoneNumberArray = $this->getData('phoneNumber');
        if (!empty($phoneNumberArray)) {
            $phoneNumber = $phoneNumberArray['prefix'] . $phoneNumberArray['number'];
            $result = preg_replace("/[^0-9]/", '', $phoneNumber);
        }

        return $result;
    }
}
