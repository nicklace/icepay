<?php namespace Phamels\Icepay;

interface PaymentmethodInterface {

    public function getCode();

    public function getReadableName();

    public function getSupportedIssuers();

    public function getSupportedCountries();

    public function getSupportedCurrency();

    public function getSupportedLanguages();

    public function getSupportedAmountRange();
    
}