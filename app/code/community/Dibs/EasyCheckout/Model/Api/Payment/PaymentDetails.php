<?php

/**
 * Class Dibs_EasyCheckout_Model_Api_Payment_PaymentDetails
 */
class Dibs_EasyCheckout_Model_Api_Payment_PaymentDetails
{
    /** @var  string */
    protected $paymentType;

    /** @var  string */
    protected $paymentMethod;

    /** @var Varien_Object  */
    protected $invoiceDetails;

    /** @var Varien_Object  */
    protected $cardDetails;

    /**
     * Dibs_EasyCheckout_Model_Api_Payment_Consumer constructor.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->paymentType = isset($data['paymentType']) ? $data['paymentType'] : null;
        $this->paymentMethod = isset($data['paymentMethod']) ? $data['paymentMethod'] : null ;
        $this->invoiceDetails = isset($data['invoiceDetails']) ? new Varien_Object($data['invoiceDetails']) : null;
        $this->cardDetails = isset($data['cardDetails']) ? new Varien_Object($data['cardDetails']) : null;
    }

    /**
     * @return null|string
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @return null|string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @return null|Varien_Object
     */
    public function getInvoiceDetails()
    {
        return $this->invoiceDetails;
    }

    /**
     * @return null|Varien_Object
     */
    public function getCardDetails()
    {
        return $this->cardDetails;
    }

    /**
     * @return mixed|null
     */
    public function getMaskedPan()
    {
        $result = null;
        $cardDetails = $this->getCardDetails();
        if (!empty($cardDetails)) {
            $result = $cardDetails->getData('maskedPan');
        }

        return $result;
    }

    /**
     * @return null|string
     */
    public function getCcLast4()
    {
        $result = null;
        $maskedPan = $this->getMaskedPan();
        if ($maskedPan != '') {
            $result = substr($maskedPan,-4);
        }

        return $result;
    }

    /**
     * @return null|string
     */
    public function getCcExpMonth()
    {
        $result = null;
        $cardDetails = $this->getCardDetails();
        if (!empty($cardDetails)) {
            $expiryDate = $cardDetails->getData('expiryDate');
            if ($expiryDate != '') {
                $result = substr($expiryDate, 0, -2);
            }
        }

        return $result;
    }

    /**
     * @return null|string
     */
    public function getCcExpYear()
    {
        $result = null;
        $cardDetails = $this->getCardDetails();
        if (!empty($cardDetails)) {
            $expiryDate = $cardDetails->getData('expiryDate');
            if ($expiryDate != '') {
                $result = substr($expiryDate, -2);
            }
        }

        return $result;
    }
}
