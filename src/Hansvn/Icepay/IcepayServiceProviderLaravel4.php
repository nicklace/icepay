<?php namespace Hansvn\Icepay;

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

		$app['config']->package('hansvn/icepay', __DIR__.'/../config');

		$app['icepay'] = $app->share(function ($app) {
			return new IcepayManager($app['config']->get('icepay::config'));
		});

		$app->alias('icepay', '\Hansvn\Icepay\Icepay');
	}

	public function boot() {
		$this->package('hansvn/icepay', 'icepay');
	}
}
