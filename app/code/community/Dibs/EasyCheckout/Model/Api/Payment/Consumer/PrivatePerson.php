<?php

/**
 * Class Dibs_EasyCheckout_Model_Api_Payment_Consumer_PrivatePerson
 */
class Dibs_EasyCheckout_Model_Api_Payment_Consumer_PrivatePerson extends Varien_Object
{
    /**
     * @return mixed|null
     */
    public function getTelephone()
    {
        $result = null;
        $phoneNumberArray = $this->getData('phoneNumber');

        if (!empty($phoneNumberArray)) {
            $result = $phoneNumberArray['prefix'] . $phoneNumberArray['number'];
        }

        return $result;
    }
}
