# Laravel Icepay

This package a Laravel integration of [the icepay api](https://github.com/icepay/icepay).
The package can also be used as-is (i.e. without Laravel)

!IMPORTANT the package has not been tested yet on all platforms!

## Requirements

- PHP >=5.4

## Getting started
------------------

### Laravel < 5.0

1.  Install the `hansvn/icepay` package

    ```shell
    $ composer require hansvn/icepay
    ```

1. Update app/config/app.php` to activate the package

    ```php
    # Add `Hansvn\Icepay\IcepayServiceProvider` to the `providers` array
    'providers' => array(
        ...
        'Hansvn\Icepay\IcepayServiceProvider',
    )

    # Add the Icepay alias
    'aliases' => array(
        ...
        'Icepay'          => 'Hansvn\Icepay\Facades\Icepay',
    )
    ```

1.  Publish the config file

    ```shell
    $ php artisan config:publish hansvn/icepay
    ```

1.  Update `app/config/packages/hansvn/icepay/config.php` with your
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

## Contributing

Contributions are welcome.

## Todo's

- Write tests