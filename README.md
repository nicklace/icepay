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
    $ composer require phamels/laravel-icepay
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

1.  Publish the config file

    ```shell
    $ php artisan config:publish phamels/laravel-icepay
    ```

1.  Update `app/config/packages/phamels/icepay/config.php` with your
    Icepay API key:

    ```php
    return array(
        'MERCHANTID'	=> xxxxx,//<--- Change this into your own merchant ID
        'SECRETCODE'	=> "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",//<--- Change this into your own merchant ID 
        ...
    );
    ```

1.  Optionally, you can set the log option to true or false to keep logs of the icepay packages

    ```php
    return array(
    	...
        'log'			=> true,
    );
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
