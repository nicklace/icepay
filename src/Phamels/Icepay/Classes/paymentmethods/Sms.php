<?php namespace Phamels\Icepay\Paymentmethod;

/**
 *  ICEPAY Basicmode API 2
 *  Phone SMS library
 *
 *  @version 1.0.1
 *  @author Olaf Abbenhuis
 *  @copyright Copyright (c) 2011, ICEPAY
 *
 */

class Sms extends Paymentmethod {
    public $_version       = "2.5.2";
    public $_method        = "SMS";
    public $_readable_name = "SMS Text";
    public $_issuer        = array('DEFAULT');
    public $_country       = array('00');
    public $_language      = array('EN', 'NL');
    public $_currency      = array('00');
    public $_amount        = array('minimum' => 30, 'maximum' => 1000000);
}


?>
