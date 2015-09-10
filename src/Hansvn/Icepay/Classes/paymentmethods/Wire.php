<?php namespace Hansvn\Icepay\Paymentmethod;

/**
 *  ICEPAY Basicmode API 2
 *  WireTransfer library
 *
 *  @version 1.0.1
 *  @author Olaf Abbenhuis
 *  @copyright Copyright (c) 2011, ICEPAY
 *
 */

class Wire extends Paymentmethod {
    public $_version       = "2.5.2";
    public $_method        = "WIRE";
    public $_readable_name = "Wire Transfer";
    public $_issuer        = array('DEFAULT');
    public $_country       = array('00');
    public $_language      = array('NL', 'EN', 'DE', 'FR', 'ES');
    public $_currency      = array('EUR', 'USD', 'GBP');
    public $_amount        = array('minimum' => 30, 'maximum' => 1000000);
}


?>
