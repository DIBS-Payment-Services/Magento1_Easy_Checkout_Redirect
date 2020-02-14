<?php

/**
 * Class Dibs_EasyCheckout_Block_Adminhtml_Sales_Order_Creditmemo_Totals
 */
class Dibs_EasyCheckout_Block_Adminhtml_Sales_Order_Creditmemo_Totals extends Mage_Adminhtml_Block_Sales_Order_Creditmemo_Totals {

    /**
     * @return Mage_Sales_Block_Order_Totals
     */
    protected function _beforeToHtml()
    {
        $isDibsEasyCheckoutPayment = $this->isDibsEasyCheckoutPayment();
        if ($isDibsEasyCheckoutPayment) {
            $this->removeAdjustmentsBlock();
        }
        return parent::_beforeToHtml();
    }

    /**
     * Remove Adjustments Block
     */
    protected function removeAdjustmentsBlock()
    {
        $this->unsetChild('adjustments');
    }

    /**
     * @return bool
     */
    protected function isDibsEasyCheckoutPayment()
    {
        $result = false;
        $paymentMethod = $this->getCreditmemo()->getOrder()->getPayment()->getMethod();
        if ($paymentMethod == Dibs_EasyCheckout_Model_Config::PAYMENT_CHECKOUT_METHOD) {
            $result = true;
        }

        return $result;
    }

}
