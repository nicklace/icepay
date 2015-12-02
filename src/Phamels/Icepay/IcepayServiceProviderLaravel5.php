<?php namespace Phamels\Icepay;

use Illuminate\Support\ServiceProvider;

class IcepayServiceProviderLaravel5 extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$app = $this->app;

		$app['icepay'] = $app->share(function ($app) {
			return new IcepayManager($app['config']->get('icepay::config'));
		});

		$app->alias('icepay', '\Phamels\Icepay\Icepay');
	}

	public function boot() {
		\App::register('\Phamels\Icepay\IcepayServiceProviderLaravel5');
	}
}
