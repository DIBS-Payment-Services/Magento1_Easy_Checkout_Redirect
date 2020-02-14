<?php

/**
 * Class DibsEasyPayment_Api_Service_Action_Payment_Create
 */
class Dibs_EasyPayment_Api_Service_Action_Payment_Create extends Dibs_EasyPayment_Api_Service_Action_AbstractAction{

    /**
     * @var string
     */
    protected $apiEndpoint = '/payments';

    /**
     * @var array
     */
    protected $orderFields = array(
        'items',
        'amount',
        'currency',
        'reference'
    );

    /**
     * @var array
     */
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
     * @var array
     */
    protected $checkoutFields = array(
        'url'
    );

    /**
     * @return string
     */
    protected function getApiEndpoint()
    {
        $url = $this->getClient()->getApiUrl() . $this->apiEndpoint;
        return $url;
    }

    /**
     * @param $params
     *
     * @return Dibs_EasyPayment_Api_Response
     */
    public function request($params)
    {
        $this->validateRequest($params);
        $apiEndPoint = $this->getApiEndpoint();
        $response = $this->getClient()->request($apiEndPoint, 'POST', $params);
        $this->validateResponse($response);
        return $response;
    }

    protected function validateResponse($response)
    {
        $responseArray = $response->getResponseArray();
        if (!isset($responseArray['paymentId']) && !empty($responseArray['paymentId'])) {
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

        if (!isset($params['order'])) {
            throw new Dibs_EasyPayment_Api_Exception_Request('parameter order is missing');
        }

        foreach ($this->orderFields as $orderField) {
            if (!isset($params['order'][$orderField])) {
                $missedParams[] = $orderField;
            }
        }
        if (!empty($missedParams)) {
            throw new Dibs_EasyPayment_Api_Exception_Request(
                'Empty order fields ' . implode(',', $missedParams)
            );
        }

        if (!isset($params['order']['items']) || empty($params['order']['items'])) {
            throw new Dibs_EasyPayment_Api_Exception_Request('Empty order items ');
        }

        foreach ($params['order']['items'] as $orderItem) {
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
