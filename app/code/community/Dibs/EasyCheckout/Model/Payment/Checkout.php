<?php

/**
 * Class Dibs_EasyCheckout_Model_Payment_Checkout
 */
class Dibs_EasyCheckout_Model_Payment_Checkout extends Mage_Payment_Model_Method_Abstract
{
    protected $_code = Dibs_EasyCheckout_Model_Config::PAYMENT_CHECKOUT_METHOD;

    protected $_canCapture                  = true;
    protected $_canCapturePartial           = true;
    protected $_canRefund                   = true;
    protected $_canRefundInvoicePartial     = true;
    protected $_canAuthorize                = true;
    protected $_formBlockType = 'Dibs_EasyCheckout_Block_Checkout_Form';
    protected $_infoBlockType = 'dibs_easycheckout/payment_info';

    /**
     * @param Varien_Object $payment
     * @param float $amount
     *
     * @return $this
     * @throws Exception
     */
    public function capture(Varien_Object $payment, $amount) {
        parent::capture($payment, $amount);

        /** @var Mage_Sales_Model_Order_Invoice $invoice */
        $invoice = $payment->getInvoice();

        if (!$invoice) {
            $message = $this->getDibsEasyCheckoutHelper()->__('Invoice is not exists');
            throw new Exception($message);
        }
        $chargeId = $this->processCharge($invoice, $amount);
        $dibsPayment = $this->getDibsPayment($invoice);
        $payment->setData('dibs_easy_payment_type', $dibsPayment->getPaymentDetails()->getPaymentType());
        $payment->setData('dibs_easy_cc_masked_pan', $dibsPayment->getPaymentDetails()->getMaskedPan());
        $payment->setData('cc_last_4', $dibsPayment->getPaymentDetails()->getCcLast4());
        $payment->setData('cc_exp_month', $dibsPayment->getPaymentDetails()->getCcExpMonth());
        $payment->setData('cc_exp_year', $dibsPayment->getPaymentDetails()->getCcExpYear());
        $payment->setStatus(self::STATUS_APPROVED);
        $payment->setTransactionId($chargeId)
            ->setIsTransactionClosed(1);
        return $this;
    }

    /**
     * @return $this
     */
    public function validate()
    {
        // No validation, it should just work when it gets here
        return $this;
    }

    /**
     * @param Varien_Object $payment
     * @param float $amount
     *
     * @return $this
     * @throws Exception
     */
    public function refund(Varien_Object $payment, $amount) {

        $chargeId = null;
        $creditMemo = $payment->getCreditmemo();
        $invoice = $creditMemo->getInvoice();
        if ($invoice && $invoice->getTransactionId()) {
            $chargeId = $invoice->getTransactionId();
        }

        if (empty($chargeId)) {
            $message = $this->getDibsEasyCheckoutHelper()->__('Dibs Charge id is empty');
            throw new Exception($message);
        }

        $refundId = $this->processRefund($creditMemo, $amount, $chargeId);
        $payment->setTransactionId($refundId)
            ->setIsTransactionClosed(1);

        return $this;
    }

    /**
     * @param Mage_Sales_Model_Order_Invoice $invoice
     * @param $amount
     *
     * @return mixed|null
     */
    public function processCharge(Mage_Sales_Model_Order_Invoice $invoice, $amount) {
        /** @var Dibs_EasyCheckout_Model_Api $api */
        $api = Mage::getModel('dibs_easycheckout/api');
        $chargeId = $api->chargePayment($invoice, $amount);
        return $chargeId;
    }

    /**
     * @param Mage_Sales_Model_Order_Creditmemo $creditmemo
     * @param $amount
     * @param $chargeId
     *
     * @return mixed|null
     */
    public function processRefund(Mage_Sales_Model_Order_Creditmemo $creditmemo, $amount, $chargeId) {
        /** @var Dibs_EasyCheckout_Model_Api $api */
        $api = Mage::getModel('dibs_easycheckout/api');
        $refundId = $api->refundPayment($chargeId, $creditmemo, $amount);
        return $refundId;
    }

    /**
     * @return Mage_Core_Helper_Abstract
     */
    public function getDibsEasyCheckoutHelper()
    {
        return Mage::helper('dibs_easycheckout');
    }

    /**
     * @param $invoice
     *
     * @return Dibs_EasyCheckout_Model_Api_Payment|null
     */
    protected function getDibsPayment($invoice)
    {
        /** @var Dibs_EasyCheckout_Model_Api $api */
        $api = Mage::getModel('dibs_easycheckout/api');
        $paymentId = $invoice->getOrder()->getDibsEasyPaymentId();
        $dibsPayment = $api->findPayment($paymentId);
        return $dibsPayment;
    }

    /**
     * Return url for redirection after order placed
     * @return string
     */
    public function getOrderPlaceRedirectUrl()
    {
        $dibsCheckout = Mage::getModel('dibs_easycheckout/checkout');
        $helper = $this->getDibsEasyCheckoutHelper();
        try {
            $result = $dibsCheckout->createPayment($helper->getQuote());
        }catch (Exception $e) {
           $result = $dibsCheckout->createPayment($helper->getQuote(), false);
        }
        return $result['hostedPaymentPageUrl'];
    }
}