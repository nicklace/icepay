<?php namespace Phamels\Icepay;

use Illuminate\Support\ServiceProvider;

class IcepayServiceProviderLaravel4 extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$app = $this->app;

		$app['config']->package('phamels/icepay', __DIR__.'/../config');

		$app['icepay'] = $app->share(function ($app) {
			return new IcepayManager($app['config']->get('icepay::config'));
		});

		$app->alias('icepay', '\Phamels\Icepay\Icepay');
	}

	public function boot() {
		$this->package('phamels/icepay', 'icepay');
	}
}
