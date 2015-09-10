<?php namespace Hansvn\Icepay;

class TransactionObject implements WebserviceTransactionInterface {

    protected $data;

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getPaymentScreenURL()
    {
        return $this->data->PaymentScreenURL;
    }

    public function getPaymentID()
    {
        return $this->data->PaymentID;
    }

    public function getProviderTransactionID()
    {
        return $this->data->ProviderTransactionID;
    }

    public function getTestMode()
    {
        return $this->data->TestMode;
    }

    public function getTimestamp()
    {
        return $this->data->Timestamp;
    }

    public function getEndUserIP()
    {
        return $this->data->EndUserIP;
    }

}