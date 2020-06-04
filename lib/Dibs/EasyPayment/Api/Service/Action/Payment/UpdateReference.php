<?php

/**
 * Class DibsEasyPayment_Api_Service_Action_Payment_UpdateReference
 */
class Dibs_EasyPayment_Api_Service_Action_Payment_UpdateReference extends Dibs_EasyPayment_Api_Service_Action_AbstractAction
{

    /**
     * @param $paymentId
     *
     * @return string
     */
    protected function getApiEndpoint($paymentId)
    {
        return $this->getClient()->getApiUrl() . $this->apiEndpoint . '/payments/' . $paymentId . '/referenceinformation';
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