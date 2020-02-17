<?php

/**
 * Class Dibs_EasyPayment_Api_Exception_Request
 */
class Dibs_EasyPayment_Api_Exception extends Exception {

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $debug = Mage::registry('easy_request_params');


        $message = "Code: " . $this->getCode() . "\n Message: " . $this->getMessage() . "\n params: \n" . $debug;


        Mage::log($message, null, 'nets.easy.log', true);
    }
}