<?php namespace Hansvn\Icepay\Paymentmethod;

/**
 *  ICEPAY Basicmode API 2
 *  PayPal library
 *
 *  @version 1.0.1
 *  @author Olaf Abbenhuis
 *  @copyright Copyright (c) 2011, ICEPAY
 *
 */

class Paypal extends Paymentmethod {
    public $_version       = "2.5.2";
    public $_method        = "PAYPAL";
    public $_readable_name = "PayPal";
    public $_issuer        = array('DEFAULT');
    public $_country       = array('00');
    public $_language      = array('00');
    public $_currency      = array('EUR', 'USD', 'GBP', 'AUD', 'CAD', 'CZK', 'DKK', 'HUF', 'JPY', 'NOK', 'NZD', 'PLN', 'SGD', 'SEK', 'CHF', 'BRL', 'HKD', 'ILS', 'MYRP', 'MXN', 'PHP', 'TWD', 'THB', 'TRY');
    public $_amount        = array('minimum' => 1, 'maximum' => 100000000);
}


?>
