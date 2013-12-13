<?php namespace Donovan\GruntStart\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class BowerInstallCommand extends Command {

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
	protected $description = 'Runs bower install';

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
		$this->info('Installing bower dependencies...');
		$this->info(shell_exec('bower install'));
		$this->info(shell_exec('sudo npm install'));
	}

	
}