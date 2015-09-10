<?php namespace Hansvn\Icepay;

/**
 *  StatusCode static class
 *  Contains the payment statuscode constants
 * 
 *  @author Olaf Abbenhuis
 *  @since 1.0.0
 */
class StatusCode {

    const OPEN = "OPEN";
    const AUTHORIZED = "AUTHORIZED";
    const ERROR = "ERR";
    const SUCCESS = "OK";
    const REFUND = "REFUND";
    const CHARGEBACK = "CBACK";

}