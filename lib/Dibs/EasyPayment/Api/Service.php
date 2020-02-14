<?php

/**
 * Class DibsEasyPayment_Api_Service
 */
class Dibs_EasyPayment_Api_Service {

    /**
     * @var Dibs_EasyPayment_Api_Client
     */
    protected $client;

    /**
     * Dibs_EasyPayment_Api_Service constructor.
     *
     * @param Dibs_EasyPayment_Api_Client $client
     */
    public function __construct(Dibs_EasyPayment_Api_Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Dibs_EasyPayment_Api_Client
     */
    public function getClient()
    {
        return $this->client;
    }

}
