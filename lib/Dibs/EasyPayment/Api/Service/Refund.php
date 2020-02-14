<?php

/**
 * Class DibsEasyPayment_Api_Service_Refund
 */
class Dibs_EasyPayment_Api_Service_Refund extends Dibs_EasyPayment_Api_Service{

    /** @var Dibs_EasyPayment_Api_Service_Action_Refund_Charge  */
    protected $charge;

    /**
     * DibsEasyPayment_Api_Service_Refund constructor.
     *
     * @param Dibs_EasyPayment_Api_Client $client
     */
    public function __construct(Dibs_EasyPayment_Api_Client $client)
    {
        $this->charge = new Dibs_EasyPayment_Api_Service_Action_Refund_Charge($this);
        parent::__construct($client);
    }

    /**
     * @param $chargeId
     * @param $params
     *
     * @return Dibs_EasyPayment_Api_Response
     */
    public function charge($chargeId, $params)
    {
        $result = $this->charge->request($chargeId, $params);
        return $result;
    }
}
