<?php namespace Minit;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\View\Engines\EngineResolver;

class ServiceProvider extends BaseServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('minit', function()
		{
			return new \Minit\Engine;
		});
		
		$this->app->singleton('view.engine.resolver', function()
		{
			$resolver = new EngineResolver;
			$resolver->register('php', function() { 
				return new \Minit\Engine;
			});
			
			return $resolver;
		});
	}

}
