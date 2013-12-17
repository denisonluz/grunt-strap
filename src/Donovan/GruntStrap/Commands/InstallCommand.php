<?php namespace Donovan\GruntStrap\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InstallCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'bbg:install';


	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Runs Bower & Grunt install';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();


	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		//
		$this->info('Installing Bower packages...');
		$this->info(shell_exec('bower install'));
		$this->info('Installing Grunt dependencies...');
		$this->info(shell_exec('sudo npm install'));
		$this->info('Running Grunt...');
		$this->info(shell_exec('grunt'));

		

	}

	
}