<?php

/**
 * Class DibsEasyPayment_Api_Service_Action_Payment_Charge
 */
class Dibs_EasyPayment_Api_Service_Action_Payment_Charge extends Dibs_EasyPayment_Api_Service_Action_AbstractAction{

    protected $apiEndpoint = '/payments';

    protected $orderFields = array(
        'amount',
        'orderItems'
    );

    protected $orderItemFields = array(
        'reference',
        'name',
        'quantity',
        'unit',
        'unitPrice',
        'taxRate',
        'taxAmount',
        'grossTotalAmount',
        'netTotalAmount'
    );

    /**
     * @param $paymentId
     *
     * @return string
     */
    protected function getApiEndpoint($paymentId)
    {
        $url = $this->getClient()->getApiUrl() . $this->apiEndpoint . '/' . $paymentId . '/charges';
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
        $this->validateRequest($params);
        $apiEndPoint = $this->getApiEndpoint($paymentId);
        $response = $this->getClient()->request($apiEndPoint, 'POST', $params);
        $this->validateResponse($response);
        return $response;
    }

    protected function validateResponse($response)
    {
        $responseArray = $response->getResponseArray();
        if (!isset($responseArray['chargeId']) && !empty($responseArray['chargeId'])) {
            throw new Dibs_EasyPayment_Api_Exception_Response('PaymentId is empty');
        }

        return $this;
    }
    /**
     * @param $params
     *
     * @return $this
     * @throws Dibs_EasyPayment_Api_Exception_Request
     */
    protected function validateRequest($params)
    {
        $missedParams = [];

        if (!isset($params['amount'])){
            throw new Dibs_EasyPayment_Api_Exception_Request('parameter amount is missing');
        }

        if (!isset($params['orderItems']) || empty($params['orderItems'])) {
            throw new Dibs_EasyPayment_Api_Exception_Request('Empty order items ');
        }

        foreach ($params['orderItems'] as $orderItem) {
            foreach ($this->orderItemFields as $orderItemField) {
                if (!isset($orderItem[$orderItemField])) {
                    $missedParams[] = $orderItemField;
                }
            }
            if (!empty($missedParams)) {
                throw new Dibs_EasyPayment_Api_Exception_Request(
                    'Empty order item fields ' . implode(',', $missedParams)
                );
            }
        }

        return $this;
    }
}
