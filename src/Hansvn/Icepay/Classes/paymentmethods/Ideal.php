<?php namespace Hansvn\Icepay\Paymentmethod;

/**
 *  ICEPAY Basicmode API 2
 *  iDeal library
 *
 *  @version 1.0.1
 *  @author Olaf Abbenhuis
 *  @copyright Copyright (c) 2011, ICEPAY
 *
 */

class Ideal extends Paymentmethod {
    public $_version       = "2.5.2";
    public $_method        = "IDEAL";
    public $_readable_name = "iDEAL";
    public $_issuer        = array('ABNAMRO', 'ASNBANK', 'ING', 'KNAB', 'RABOBANK', 'SNSBANK', 'SNSREGIOBANK', 'TRIODOSBANK', 'VANLANSCHOT');
    public $_country       = array('NL');
    public $_language      = array('NL');
    public $_currency      = array('EUR');
    public $_amount        = array('minimum' => 30, 'maximum' => 1000000);
}


?>
