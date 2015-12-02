<?php namespace Phamels\Icepay;

use Illuminate\Support\ServiceProvider;

class IcepayServiceProviderLumen extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$app = $this->app;

		$app['icepay'] = $app->share(function ($app) {
			return new Icepay($app['config']->get('icepay::config'));
		});

		$app->alias('icepay', '\Phamels\Icepay\Icepay');
	}

	public function boot() {
		$this->package('phamels/icepay', 'icepay');
	}
}