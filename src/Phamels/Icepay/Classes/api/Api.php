<?php namespace Phamels\Icepay\API;

use Phamels\Icepay\ParameterValidation;

/**
 *  \API\Base class
 *  Basic Setters and Getters required in most API
 * 
 *  @author Olaf Abbenhuis
 *  @author Wouter van Tilburg
 *  @package API_Base
 *  @since 1.0.0
 *  @version 1.0.2
 *
 */
class Api {

    private $_pinCode;
    protected $_merchantID;
    protected $_secretCode;
    protected $_method = null;
    protected $_issuer = null;
    protected $_country = null;
    protected $_language = null;
    protected $_currency = null;
    protected $_version = "1.0.2";
    protected $_whiteList = array();
    protected $data;
    protected $_logger;

    public function __construct()
    {
        $this->_logger = Logger::getInstance();
        $this->data = new \stdClass();
    }

    public function setLogger($logger) {
        if(get_class($logger) == "Phamels\Icepay\API\Logger")
            $this->_logger = $logger;
        else
            throw new Exception("Logger must be an instance of 'Phamels\Icepay\API\Logger' on setLogger", 500);
    }

    /**
     * Validate data
     * @since version 1.0.0
     * @access public
     * @param string $needle
     * @param array $haystack
     * @return boolean
     */
    public function exists($needle, $haystack = null)
    {
        $result = true;
        if ($haystack && $result && $haystack[0] != "00")
            $result = in_array($needle, $haystack);
        return $result;
    }

    /**
     * Get the version of the API or the loaded payment method class
     * @since 1.0.0
     * @access public
     * @return string Version
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the Merchant ID field
     * @since 1.0.0
     * @access public
     * @param (int) $merchantID
     */
    public function setMerchantID($merchantID)
    {
        if (!ParameterValidation::merchantID($merchantID))
            throw new \Exception('MerchantID not valid');

        $this->_merchantID = (int) $merchantID;

        return $this;
    }

    /**
     * Get the Merchant ID field
     * @since 1.0.0
     * @access public
     * @return (int) MerchantID
     */
    public function getMerchantID()
    {
        return $this->_merchantID;
    }

    /**
     * Set the Secret Code field
     * @since 1.0.0
     * @access public
     * @param (string) $secretCode
     */
    public function setSecretCode($secretCode)
    {
        if (!ParameterValidation::secretCode($secretCode))
            throw new \Exception('Secretcode not valid');

        $this->_secretCode = (string) $secretCode;
        return $this;
    }

    /**
     * Get the Secret Code field
     * @since 1.0.0
     * @access protected
     * @return (string) Secret Code
     */
    protected function getSecretCode()
    {
        return $this->_secretCode;
    }

    /**
     * Set the Pin Code field
     * @since 1.0.1
     * @access public
     * @param (int) $pinCode 
     */
    public function setPinCode($pinCode)
    {
        if (!ParameterValidation::pinCode($pinCode))
            throw new \Exception('Pincode not valid');

        $this->_pinCode = (string) $pinCode;

        return $this;
    }

    /**
     * Get the Pin Code field
     * @since 1.0.0
     * @access protected
     * @return (int) PinCode
     */
    protected function getPinCode()
    {
        return $this->_pinCode;
    }

    /**
     * Set the success url field (optional)
     * @since version 1.0.1
     * @access public
     * @param string $url
     */
    public function setSuccessURL($url = "")
    {
        if (!isset($this->data))
            $this->data = new \stdClass();

        $this->data->ic_urlcompleted = $url;

        return $this;
    }

    /**
     * Set the error url field (optional)
     * @since version 1.0.1
     * @access public
     * @param string $url
     */
    public function setErrorURL($url = "")
    {
        if (!isset($this->data))
            $this->data = new \stdClass();

        $this->data->ic_urlerror = $url;
        return $this;
    }

    /**
     * Get the success URL
     * @since version 2.1.0
     * @access public
     * @return string $url
     */
    public function getSuccessURL()
    {
        return (isset($this->data->ic_urlcompleted)) ? $this->data->ic_urlcompleted : "";
    }

    /**
     * Get the error URL
     * @since version 2.1.0
     * @access public
     * @return string $url
     */
    public function getErrorURL()
    {
        return (isset($this->data->ic_urlerror)) ? $this->data->ic_urlerror : "";
    }

    public function getTimestamp()
    {
        return gmdate("Y-m-d\TH:i:s\Z");
    }

}