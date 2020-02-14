<?php

/**
 * Class Dibs_EasyCheckout_Model_Observer
 */
class Dibs_EasyCheckout_Model_Observer extends Mage_Core_Model_Abstract
{
    /**
     * @param $observer
     */
    public function validateDibsEasyPaymentId($observer)
    {
        /*
        $quote = $observer->getQuote();
        $grandTotal = (double)$quote->getGrandTotal();
        $dibsEasyGrandTotal = (double)$quote->getDibsEasyGrandTotal();
        if ($grandTotal != $dibsEasyGrandTotal) {
            $quote->setDibsEasyPaymentId('');
        }*/
    }

    /**
     * @param $observer
     *
     * @return $this
     */
    public function saveOrderDibsEasyPaymentDetails($observer)
    {
        /** @var Mage_Sales_Model_Quote $quote */
        $quote = $observer->getQuote();

        /** @var Mage_Sales_Model_Order $order */
        $order = $observer->getOrder();

        /** @var Mage_Sales_Model_Quote_Payment $quotePayment */
        $quotePayment = $quote->getPayment();

        /** @var Mage_Sales_Model_Order_Payment $orderPayment */
        $orderPayment = $order->getPayment();

        $order->setData('dibs_easy_payment_id', $quote->getData('dibs_easy_payment_id'));
        $orderPayment->setData('dibs_easy_cc_masked_pan', $quotePayment->getData('dibs_easy_cc_masked_pan'));
        $orderPayment->setData('dibs_easy_payment_type', $quotePayment->getData('dibs_easy_payment_type'));
        return $this;
    }

    /**
     * @param $observer
     *
     * @return $this
     */
    public function setInvoiceToPaymentObject($observer)
    {
        $invoice = $observer->getInvoice();
        $payment = $observer->getPayment();
        $payment->setInvoice($invoice);
        return $this;
    }

    /**
     * @param Varien_Event_Observer $observer
     */
    public function setPaymentMethodAvailable(Varien_Event_Observer $observer)
    {
        $methodInstance = $observer->getEvent()->getMethodInstance();
        /** @var Mage_Sales_Model_Quote $quote */
        $quote = $observer->getEvent()->getQuote();
        if ($methodInstance instanceof \Dibs_EasyCheckout_Model_Payment_Checkout
            && $quote->getDibsEasyIsCreatingPayment()) {
            /** @var \StdClass $result */
            $result = $observer->getEvent()->getResult();
            /** @var Dibs_EasyCheckout_Helper_Data $helper */
            $helper = Mage::helper('dibs_easycheckout');
            $result->isAvailable = $helper->isEasyCheckoutAvailable();
            $result->isDeniedInConfig = !$result->isAvailable;
        }
    }

}
