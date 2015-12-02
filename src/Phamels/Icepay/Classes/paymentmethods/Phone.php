<?php namespace Phamels\Icepay\Paymentmethod;

/**
 *  ICEPAY Basicmode API 2
 *  Phone progressbar library
 *
 *  @version 1.0.1
 *  @author Olaf Abbenhuis
 *  @copyright Copyright (c) 2011, ICEPAY
 *
 */

class Phone extends Paymentmethod {
    public $_version       = "2.5.2";
    public $_method        = "PHONE";
    public $_readable_name = "Phone (Progressbar)";
    public $_issuer        = array('PBAR');
    public $_country       = array('00');
    public $_language      = array('00');
    public $_currency      = array('00');
    public $_amount        = array('minimum' => 30, 'maximum' => 1000000);
}


?>
