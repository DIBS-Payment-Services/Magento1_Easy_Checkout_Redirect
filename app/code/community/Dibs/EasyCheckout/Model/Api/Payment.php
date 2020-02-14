<?php

/**
 * Class Dibs_EasyCheckout_Model_Api_Payment
 */
class Dibs_EasyCheckout_Model_Api_Payment
{
    /** @var  string */
    protected $paymentId;

    /** @var Varien_Object  */
    protected $summary;

    /** @var Dibs_EasyCheckout_Model_Api_Payment_Consumer  */
    protected $consumer;

    /** @var Dibs_EasyCheckout_Model_Api_Payment_PaymentDetails  */
    protected $paymentDetails;

    /** @var Varien_Object  */
    protected $orderDetails;

    /** @var Varien_Object  */
    protected $checkout;

    /** @var null|Varien_Object  */
    protected $refunds;

    /** @var DateTime  */
    protected $created;

    public function __construct($data)
    {
        $this->paymentId = $data['paymentId'];
        $this->created = new DateTime($data['created']);
        $this->summary = new Varien_Object($data['summary']);
        $this->consumer = new Dibs_EasyCheckout_Model_Api_Payment_Consumer($data['consumer']);
        $this->paymentDetails = new Dibs_EasyCheckout_Model_Api_Payment_PaymentDetails($data['paymentDetails']);
        $this->orderDetails = new Varien_Object($data['orderDetails']);
        $this->checkout = new Varien_Object($data['checkout']);
        $this->refunds = isset($data['refunds']) ? new Varien_Object($data['refunds']) : null;

    }

    /**
     * @return string
     */
    public function getPaymentId()
    {
        return $this->paymentId;
    }

    /**
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return Dibs_EasyCheckout_Model_Api_Payment_Consumer_Address
     */
    public function getBillingAddress()
    {
       return $this->consumer->getBillingAddress();
    }

    /**
     * @return Dibs_EasyCheckout_Model_Api_Payment_Consumer_Address
     */
    public function getShippingAddress()
    {
       return $this->consumer->getShippingAddress();
    }

    /**
     * @return Dibs_EasyCheckout_Model_Api_Payment_Consumer_Company
     */
    public function getCompany()
    {
        return $this->consumer->getCompany();
    }

    /**
     * @return Dibs_EasyCheckout_Model_Api_Payment_Consumer_PrivatePerson
     */
    public function getPrivatePerson()
    {
        return $this->consumer->getPrivatePerson();
    }

    /**
     * @return Dibs_EasyCheckout_Model_Api_Payment_PaymentDetails
     */
    public function getPaymentDetails()
    {
        return $this->paymentDetails;
    }

    /**
     * @return Varien_Object
     */
    public function getOrderDetails()
    {
        return $this->orderDetails;
    }

    /**
     * @return Varien_Object
     */
    public function getCheckout()
    {
        return $this->checkout;
    }

    /**
     * @return null|Varien_Object
     */
    public function getRefunds()
    {
       return $this->refunds;
    }

    /**
     * @return Varien_Object
     */
    public function getSummary()
    {
        return $this->summary;
    }
}
