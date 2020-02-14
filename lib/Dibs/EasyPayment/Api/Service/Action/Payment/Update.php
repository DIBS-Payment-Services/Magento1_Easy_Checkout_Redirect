<?php

/**
 * Class DibsEasyPayment_Api_Service_Action_Payment_Update
 */
class Dibs_EasyPayment_Api_Service_Action_Payment_Update extends Dibs_EasyPayment_Api_Service_Action_AbstractAction{
    protected $apiEndpoint = '/payments';

    /**
     * @param $paymentId
     *
     * @return string
     */
    protected function getApiEndpoint($paymentId)
    {
        $url = $this->getClient()->getApiUrl() . $this->apiEndpoint . '/' . $paymentId . '/orderitems';
        return $url;
    }

    /**
     * @param $paymentId
     * @param $params
     *
     * @return Dibs_EasyPayment_Api_Response
     */
    public function request($paymentId, $params)
    {
        $apiEndPoint = $this->getApiEndpoint($paymentId);
        $response = $this->getClient()->request($apiEndPoint, 'PUT', $params);
        return $response;
    }
}
