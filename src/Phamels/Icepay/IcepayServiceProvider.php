<?php namespace Phamels\Icepay;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class IcepayServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Actual provider
	 *
	 * @var \Illuminate\Support\ServiceProvider
	 */
	protected $provider;

	/**
	 * Create a new service provider instance.
	 *
	 * @param  \Illuminate\Contracts\Foundation\Application  $app
	 * @return void
	 */
	public function __construct($app)
	{
		parent::__construct($app);
		$this->provider = $this->getProvider();
	}

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		return $this->provider->boot();
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		return $this->provider->register();
	}

	/**
	 * Return ServiceProvider according to Laravel version
	 *
	 * @return \Phamels\Icepay\Provider\ProviderInterface
	 */
	private function getProvider()
	{
		if (get_class($this->app) == 'Laravel\Lumen\Application') {
			$provider = '\Phamels\Icepay\IcepayServiceProviderLumen';
		} elseif (version_compare(Application::VERSION, '5.0', '<')) {
			$provider = '\Phamels\Icepay\IcepayServiceProviderLaravel4';
		} else {
			$provider = '\Phamels\Icepay\IcepayServiceProviderLaravel5';
		}
		return new $provider($this->app);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('icepay');
	}
}