<?php namespace Hansvn\Icepay\Paymentmethod;

/**
 *  ICEPAY Basicmode API 2
 *  Giropay library
 *
 *  @version 1.0.1
 *  @author Olaf Abbenhuis
 *  @copyright Copyright (c) 2011, ICEPAY
 *
 */

class Giropay extends Paymentmethod {
    public $_version       = "2.5.2";
    public $_method        = "GIROPAY";
    public $_readable_name = "Giropay";
    public $_issuer        = array('DEFAULT');
    public $_country       = array('DE');
    public $_language      = array('DE');
    public $_currency      = array('EUR');
    public $_amount        = array('minimum' => 30, 'maximum' => 1000000);
}


?>
