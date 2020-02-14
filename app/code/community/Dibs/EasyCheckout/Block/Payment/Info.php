<?php

/**
 * Class Dibs_EasyCheckout_Block_Payment_Info
 */
class Dibs_EasyCheckout_Block_Payment_Info extends Mage_Payment_Block_Info
{
    /**
     * Set template
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('dibs/easycheckout/info.phtml');
    }
    /**
     * @param null $transport
     *
     * @return Varien_Object
     */
    protected function _prepareSpecificInformation($transport = null)
    {
        $transport = parent::_prepareSpecificInformation($transport);
        $order = $this->getInfo()->getOrder();
        if ($order) {
            $paymentIdLabel = $this->__('Payment ID');
            $paymentTypeLabel = $this->__('Payment Type');
            $maskedPanLabel = $this->__('Masked Pan');

            $paymentData = [];
            $paymentData[$paymentIdLabel] = $this->getInfo()->getOrder()->getData('dibs_easy_payment_id');

            $dibsEasyPaymentType = $this->getInfo()->getData('dibs_easy_payment_type');
            if (!empty($dibsEasyPaymentType)) {
                $paymentData[$paymentTypeLabel] = $dibsEasyPaymentType;
            }

            $dibsEasyMaskedPan = $this->getInfo()->getData('dibs_easy_cc_masked_pan');
            if (!empty($dibsEasyMaskedPan)) {
                $paymentData[$maskedPanLabel] = $dibsEasyMaskedPan;
            }

            $transport->addData($paymentData);
        }

        return $transport;
    }
}
