<?php

/**
 * Class DibsEasyPayment_Api_Service_Action_Refund_Charge
 */
class Dibs_EasyPayment_Api_Service_Action_Refund_Charge extends Dibs_EasyPayment_Api_Service_Action_AbstractAction{

    protected $apiEndpoint = '/charges';

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
     * @param $chargeId
     *
     * @return string
     */
    public function getApiEndpoint($chargeId)
    {
        $url = $this->getClient()->getApiUrl() . $this->apiEndpoint . '/' . $chargeId . '/refunds';
        return $url;
    }

    /**
     * @param $chargeId
     * @param $params
     *
     * @return Dibs_EasyPayment_Api_Response
     */
    public function request($chargeId, $params)
    {
        $this->validateRequest($params);
        $apiEndPoint = $this->getApiEndpoint($chargeId);
        $response = $this->getClient()->request($apiEndPoint, 'POST', $params);
        $this->validateResponse($response);
        return $response;
    }

    /**
     * @param $response
     *
     * @return $this
     * @throws Dibs_EasyPayment_Api_Exception_Response
     */
    protected function validateResponse($response)
    {
        $responseArray = $response->getResponseArray();
        if (!isset($responseArray['refundId']) && !empty($responseArray['refundId'])) {
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

        if (!isset($params['amount'])) {
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
