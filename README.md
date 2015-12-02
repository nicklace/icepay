# Laravel Icepay for Laravel 5.1

Updated the code from the [Laravel Icepay](https://github.com/hansvn/icepay) package to be able to use it with Laravel 5.1

## Requirements

- PHP >=5.5
- Laravel >= 5.1

## Getting started
------------------

### Laravel >= 5.1

1.  Install the `phamels/laravel-icepay` package

    ```shell
    $ composer require phamels/laravel-icepay:dev-master
    ```

1. Update app/config/app.php` to activate the package

    ```php
    # Add `Phamels\Icepay\IcepayServiceProvider` to the `providers` array
    'providers' => array(
        ...
        Phamels\Icepay\IcepayServiceProvider::class,
    )

    # Add the Icepay alias
    'aliases' => array(
        ...
        'Icepay'          => Phamels\Icepay\Facades\Icepay::class,
    )
    ```

1.  Define the config parameters in your `config/services.php` file

    ```php
        'icepay' => [
            'MERCHANTID'	=> xxxxx,
            'SECRETCODE'	=> "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
            'log'			=> true
        ],
    ```

## Usage
Below is a simple usage example of this package

Generate a payment link for &euro;10,00:

```php
$icepay = \Icepay::paymentObject();
$icepay->setAmount(1000)
			->setCountry("BE")
			->setLanguage("NL")
			->setReference("My Sample Website")
			->setDescription("My Sample Payment")
			->setCurrency("EUR");

$basic = Icepay::basicMode();
$basic->validatePayment($icepay);

return sprintf("<a href=\"%s\">%s</a>",$basic->getURL(),$basic->getURL());
```


## Contributing

Contributions are welcome.

## Todo's

- Write tests
