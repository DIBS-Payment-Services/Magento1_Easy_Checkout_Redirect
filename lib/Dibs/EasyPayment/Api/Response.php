<?php

/**
 * Class Dibs_EasyPayment_Api_Response
 */
class Dibs_EasyPayment_Api_Response {

    protected $code;

    protected $response;

    protected $success = false;

    /**
     * DibsEasyPayment_Api_Response constructor.
     *
     * @param $code
     * @param string $responseJson
     */
    public function __construct($code, $responseJson ='')
    {
        $this->code = $code;
        $this->response = $responseJson;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $response
     *
     * @return $this
     */
    public function setResponse($response = '')
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    public function setSuccess($success)
    {
        $this->success = $success;
        return $this;
    }

    public function getSuccess()
    {
        return $this->success;
    }

    public function getMessage()
    {
        $result = '';
        $responseArray = $this->getResponseArray();
        if (isset($responseArray['message'])) {
            $result = $responseArray['message'];
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        $result = [];
        $responseArray = $this->getResponseArray();
        if (isset($responseArray['errors'])) {
            $result = $responseArray['errors'];
        }

        return $result;
    }

    public function getErrorMessages()
    {
        $result = [];
        $errors = $this->getErrors();
        foreach ($errors as $errorType) {
            foreach ($errorType as $error) {
                $result[] = $error;
            }
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function getResponseArray()
    {
        $result = json_decode($this->response, true);
        return $result;
    }

    public function getResponseDataObject()
    {
        $dataObject = new Varien_Object($this->getResponseArray());
        return $dataObject;
    }
}
