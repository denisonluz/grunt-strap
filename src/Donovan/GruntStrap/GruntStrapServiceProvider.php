<?php namespace Donovan\GruntStrap;


use Donovan\GruntStrap\Commands;
use Illuminate\Support\ServiceProvider;

class GruntStrapServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

		$this->registerBowerPublish();
		$this->registerBowerInstall();
		$this->commands(
			'bbg:publish',
			'bbg:install'
		
		);

	}

	protected function registerBowerPublish()
	{
		$this->app['bbg:publish'] = $this->app->share(function($app)
		{	
			$bower_generator = new Commands\BowerGenerator($app['files']);
			$grunt_generator = new Commands\GruntGenerator($app['files']);

			return new Commands\PublishCommand($bower_generator,$grunt_generator);
		});
	}

	protected function registerBowerInstall()
	{
		$this->app['bbg:install'] = $this->app->share(function($app)
		{	
			

			return new Commands\InstallCommand();
		});
	}


	public function boot(){

		$this->package('donovan/grunt-strap');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}