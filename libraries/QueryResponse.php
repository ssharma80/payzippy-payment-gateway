<?php
require_once APPPATH."packages/payment/payzippy/libraries/PZ_Utils.php";
require_once APPPATH."packages/payment/payzippy/libraries/PZ_Constants.php";
require_once APPPATH."packages/payment/payzippy/libraries/QueryTransactionResponse.php";

class QueryResponse
{
    private $params = array();
    private $transaction_responses = array();

    function __construct($response)
    {
        $this->params = json_decode($response, true);

        foreach ($this->params["data"] as $key => $value) {
            $this->transaction_responses[$key] = new QueryTransactionResponse($value);
        }
    }

    public function get_status_code()
    {
        return $this->params[PZ_Constants::PARAMETER_STATUS_CODE];
    }

    public function get_status_message()
    {
        return $this->params[PZ_Constants::PARAMETER_STATUS_MESSAGE];
    }

    public function get_error_code()
    {   
        if (isset($this->params[PZ_Constants::PARAMETER_ERROR_CODE])) {
            return $this->params[PZ_Constants::PARAMETER_ERROR_CODE];
        } else {
            return NULL;
        }
        
    }

    public function get_error_message()
    {
        if (isset($this->params[PZ_Constants::PARAMETER_ERROR_MESSAGE])) {
            return $this->params[PZ_Constants::PARAMETER_ERROR_MESSAGE];
        } else {
            return NULL;
        }
        
    }

    public function get_merchant_id()
    {
        return $this->params[PZ_Constants::PARAMETER_MERCHANT_ID];
    }

    public function get_merchant_key_id()
    {
        return $this->params[PZ_Constants::PARAMETER_MERCHANT_KEY_ID];
    }

    public function get_hash_method()
    {
        return $this->params[PZ_Constants::PARAMETER_HASH_METHOD];
    }

    public function get_hash()
    {
        return $this->params[PZ_Constants::PARAMETER_HASH];
    }

    public function validate()
    {
        $hash = PZ_Utils::generate_hash($this->get_response_params());
        $hash_match = $hash == $this->get_hash() ? TRUE : FALSE;
        return $hash_match;
    }

    public function get_transaction_responses()
    {
        return $this->transaction_responses;
    }

    public function get_response_params()
    {
        return $this->params;
    }
}

?>