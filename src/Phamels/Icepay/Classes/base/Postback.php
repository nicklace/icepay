<?php namespace Phamels\Icepay;

/**
 *  Postback class
 *  To handle the postback
 * 
 *  @author Olaf Abbenhuis
 *  @author Wouter van Tilburg
 * 
 *  @since 1.0.0
 */
class Postback extends \Phamels\Icepay\API\Api {

    public function __construct()
    {
        parent::__construct();
        $this->data = new \stdClass();
    }

    /**
     * Return minimized transactional data
     * @since version 1.0.0
     * @access public
     * @return string
     */
    public function getTransactionString()
    {
        return sprintf(
                "Paymentmethod: %s \n| OrderID: %s \n| Status: %s \n| StatusCode: %s \n| PaymentID: %s \n| TransactionID: %s \n| Amount: %s", isset($this->data->paymentMethod) ? $this->data->paymentMethod : "", isset($this->data->orderID) ? $this->data->orderID : "", isset($this->data->status) ? $this->data->status : "", isset($this->data->statusCode) ? $this->data->statusCode : "", isset($this->data->paymentID) ? $this->data->paymentID : "", isset($this->data->transactionID) ? $this->data->transactionID : "", isset($this->data->amount) ? $this->data->amount : ""
        );
    }

    /**
     * Return the statuscode field
     * @since version 1.0.0
     * @access public
     * @return string
     */
    public function getStatus()
    {
        return (isset($this->data->status)) ? $this->data->status : null;
    }

    /**
     * Return the orderID field
     * @since version 1.0.0
     * @access public
     * @return string
     */
    public function getOrderID()
    {
        return (isset($this->data->orderID)) ? $this->data->orderID : null;
    }

    /**
     * Return the postback checksum
     * @since version 1.0.0
     * @access protected
     * @return string SHA1 encoded
     */
    protected function generateChecksumForPostback()
    {
        return sha1(
                sprintf("%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s", $this->_secretCode, $this->_merchantID, $this->data->status, $this->data->statusCode, $this->data->orderID, $this->data->paymentID, $this->data->reference, $this->data->transactionID, $this->data->amount, $this->data->currency, $this->data->duration, $this->data->consumerIPAddress
                )
        );
    }

    /**
     * Return the version checksum
     * @since version 1.0.2
     * @access protected
     * @return string SHA1 encoded
     */
    protected function generateChecksumForVersion()
    {
        return sha1(
                sprintf("%s|%s|%s|%s", $this->_secretCode, $this->_merchantID, $this->data->status, substr(strval(time()), 0, 8)
                )
        );
    }

    /**
     * Returns the postback response parameter names, useful for a database install script
     * @since version 1.0.1
     * @access public
     * @return array
     */
    public function getPostbackResponseFields()
    {
        return array(
            //object reference name => post param name
            "status" => "Status",
            "statusCode" => "StatusCode",
            "merchant" => "Merchant",
            "orderID" => "OrderID",
            "paymentID" => "PaymentID",
            "reference" => "Reference",
            "transactionID" => "TransactionID",
            "consumerName" => "ConsumerName",
            "consumerAccountNumber" => "ConsumerAccountNumber",
            "consumerAddress" => "ConsumerAddress",
            "consumerHouseNumber" => "ConsumerHouseNumber",
            "consumerCity" => "ConsumerCity",
            "consumerCountry" => "ConsumerCountry",
            "consumerEmail" => "ConsumerEmail",
            "consumerPhoneNumber" => "ConsumerPhoneNumber",
            "consumerIPAddress" => "ConsumerIPAddress",
            "amount" => "Amount",
            "currency" => "Currency",
            "duration" => "Duration",
            "paymentMethod" => "PaymentMethod",
            "checksum" => "Checksum");
    }

    /**
     * Validate for version check
     * @since version 1.0.2
     * @access public
     * @return boolean
     */
    public function validateVersion()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->_logger->log('Invalid request method', \Phamels\Icepay\API\Logger::ERROR);
            return false;
        }

        if ($this->generateChecksumForVersion() != $this->data->checksum) {
            $this->_logger->log('Checksum does not match', \Phamels\Icepay\API\Logger::ERROR);
            return false;
        }

        return true;
    }

    /**
     * Has Version Check status
     * @since version 1.0.2
     * @access public
     * @return boolean
     */
    public function isVersionCheck()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->_logger->log('Invalid request method', \Phamels\Icepay\API\Logger::ERROR);
            return false;
        }

        if ($this->data->status != "VCHECK")
            return false;

        return true;
    }

    /**
     * Validate the postback data
     * @since version 1.0.0
     * @access public
     * @return boolean
     */
    public function validate()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->_logger->log("Invalid request method", \Phamels\Icepay\API\Logger::ERROR);
            return false;
        };

        $this->_logger->log(sprintf("Postback: %s", serialize($_POST)), \Phamels\Icepay\API\Logger::TRANSACTION);

        /* @since version 1.0.2 */
        foreach ($this->getPostbackResponseFields() as $obj => $param) {
            $this->data->$obj = (isset($_POST[$param])) ? $_POST[$param] : "";
        }

        if ($this->isVersionCheck())
            return false;

        if (!ParameterValidation::merchantID($this->data->merchant)) {
            $this->_logger->log("Merchant ID is not numeric: {$this->data->merchant}", \Phamels\Icepay\API\Logger::ERROR);
            return false;
        }

        if (!ParameterValidation::amount($this->data->amount)) {
            $this->_logger->log("Amount is not numeric: {$this->data->amount}", \Phamels\Icepay\API\Logger::ERROR);
            return false;
        }

        if ($this->_merchantID != $this->data->merchant) {
            $this->_logger->log("Invalid Merchant ID: {$this->data->merchant}", \Phamels\Icepay\API\Logger::ERROR);
            return false;
        }

        if (!in_array(strtoupper($this->data->status), array(
                    StatusCode::OPEN,
                    StatusCode::AUTHORIZED,
                    StatusCode::SUCCESS,
                    StatusCode::ERROR,
                    StatusCode::REFUND,
                    StatusCode::CHARGEBACK
                ))) {
            $this->_logger->log("Unknown status: {$this->data->status}", \Phamels\Icepay\API\Logger::ERROR);
            return false;
        }

        if ($this->generateChecksumForPostback() != $this->data->checksum) {
            $this->_logger->log("Checksum does not match", \Phamels\Icepay\API\Logger::ERROR);
            return false;
        }
        return true;
    }

    /**
     * Return the postback data
     * @since version 1.0.0
     * @access public
     * @return object
     */
    public function getPostback()
    {
        return $this->data;
    }

    /**
     * Check between ICEPAY statuscodes whether the status can be updated.
     * @since version 1.0.0
     * @access public
     * @param string $currentStatus The ICEPAY statuscode of the order before a statuschange
     * @return boolean
     */
    public function canUpdateStatus($currentStatus)
    {
        if (!isset($this->data->status)) {
            $this->_logger->log("Status not set", \Phamels\Icepay\API\Logger::ERROR);
            return false;
        }

        switch ($this->data->status) {
            case StatusCode::SUCCESS: return ($currentStatus == StatusCode::ERROR || $currentStatus == StatusCode::AUTHORIZED || $currentStatus == StatusCode::OPEN);
            case StatusCode::OPEN: return ($currentStatus == StatusCode::OPEN);
            case StatusCode::AUTHORIZED: return ($currentStatus == StatusCode::OPEN);
            case StatusCode::ERROR: return ($currentStatus == StatusCode::OPEN || $currentStatus == StatusCode::AUTHORIZED);
            case StatusCode::CHARGEBACK: return ($currentStatus == StatusCode::SUCCESS);
            case StatusCode::REFUND: return ($currentStatus == StatusCode::SUCCESS);
            default:
                return false;
        };
    }

}