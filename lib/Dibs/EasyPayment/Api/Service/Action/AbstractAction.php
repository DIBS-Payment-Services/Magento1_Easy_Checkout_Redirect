<?php

/**
 * Class Dibs_EasyPayment_Api_Service_Action_AbstractAction
 */
abstract class Dibs_EasyPayment_Api_Service_Action_AbstractAction
{

    /** @var Dibs_EasyPayment_Api_Service  */
    protected $service;

    /**
     * DibsEasyPayment_Api_Service_Action_AbstractAction constructor.
     *
     * @param Dibs_EasyPayment_Api_Service $service
     */
    public function __construct(Dibs_EasyPayment_Api_Service $service)
    {
        $this->service = $service;
    }

    /**
     * @return Dibs_EasyPayment_Api_Service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @return Dibs_EasyPayment_Api_Client
     */
    public function getClient()
    {
        return $this->getService()->getClient();
    }
}
