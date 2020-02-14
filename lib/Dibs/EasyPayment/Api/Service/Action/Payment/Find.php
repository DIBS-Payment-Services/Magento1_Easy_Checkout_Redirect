<?php

/**
 * Class DibsEasyPayment_Api_Service_Action_Payment_Find
 */
class Dibs_EasyPayment_Api_Service_Action_Payment_Find extends Dibs_EasyPayment_Api_Service_Action_AbstractAction{


    protected $apiEndpoint = '/payments';

    /**
     * @param $paymentId
     *
     * @return string
     */
    protected function getApiEndpoint($paymentId)
    {
        $url = $this->getClient()->getApiUrl() . $this->apiEndpoint. '/' . $paymentId;
        return $url;
    }

    /**
     * @param $paymentId
     *
     * @return Dibs_EasyPayment_Api_Response
     */
    public function request($paymentId)
    {
        if (empty($paymentId)) {
            throw new Dibs_EasyPayment_Api_Exception_Request('Empty paymentId');
        }
        $apiEndPoint = $this->getApiEndpoint($paymentId);
        $response = $this->getClient()->request($apiEndPoint,'GET');
        $this->validateResponse($response);
        return $response;
    }

    protected function validateResponse($response)
    {
        $responseArray = $response->getResponseArray();
        if (!isset($responseArray['payment']) && !empty($responseArray['payment'])) {
            throw new Dibs_EasyPayment_Api_Exception_Response('PaymentId is empty');
        }

        return $this;
    }
}
