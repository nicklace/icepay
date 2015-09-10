<?php namespace Hansvn\Icepay\Paymentmethod;

/**
 *  ICEPAY Basicmode API 2
 *  PaySafeCard library
 *
 *  @version 1.0.1
 *  @author Olaf Abbenhuis
 *  @copyright Copyright (c) 2011, ICEPAY
 *
 */

class Paysafecard extends Paymentmethod {
    public $_version       = "2.5.2";
    public $_method        = "PAYSAFECARD";
    public $_readable_name = "PaySafeCard";
    public $_issuer        = array('DEFAULT');
    public $_country       = array('00');
    public $_language      = array('00');
    public $_currency      = array('EUR', 'USD', 'GBP');
    public $_amount        = array( 'minimum' => 30, 'maximum' => 1000000);
}


?>
