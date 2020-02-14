<?php

/**
 * Class Dibs_EasyCheckout_Model_Api_Payment_Consumer
 */
class Dibs_EasyCheckout_Model_Api_Payment_Consumer
{
    /** @var Dibs_EasyCheckout_Model_Api_Payment_Consumer_Address  */
    protected $billingAddress;

    /** @var Dibs_EasyCheckout_Model_Api_Payment_Consumer_Address  */
    protected $shippingAddress;

    /** @var Dibs_EasyCheckout_Model_Api_Payment_Consumer_Company  */
    protected $company;

    /** @var Dibs_EasyCheckout_Model_Api_Payment_Consumer_PrivatePerson  */
    protected $privatePerson;

    /**
     * Dibs_EasyCheckout_Model_Api_Payment_Consumer constructor.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $billingAddress = isset($data['billingAddress']) ? $data['billingAddress'] : array();
        $this->billingAddress = Mage::getModel('dibs_easycheckout/api_payment_consumer_address', $billingAddress);
        $this->shippingAddress = Mage::getModel('dibs_easycheckout/api_payment_consumer_address', $data['shippingAddress']);
        $this->company = Mage::getModel('dibs_easycheckout/api_payment_consumer_company', $data['company']);
        $this->privatePerson = Mage::getModel('dibs_easycheckout/api_payment_consumer_PrivatePerson', $data['privatePerson']);
    }

    /**
     * @return Dibs_EasyCheckout_Model_Api_Payment_Consumer_Address
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @return Dibs_EasyCheckout_Model_Api_Payment_Consumer_Address
     */
    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }

    /**
     * @return Dibs_EasyCheckout_Model_Api_Payment_Consumer_Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return Dibs_EasyCheckout_Model_Api_Payment_Consumer_PrivatePerson
     */
    public function getPrivatePerson()
    {
        return $this->privatePerson;
    }
}
