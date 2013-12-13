<?php namespace Donovan\GruntStart\Commands;


use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class BowerPublishCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'bbg:publish';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Publishes templates for Bower (.bowerrc, bower.json) and Grunt (Gruntfile.js , package.json) in the project root';

	/**
	 * Bower File generator
	 *
	 * @var BowerGenerator
	 */
	protected $bower;

		/**
	 * Bower File generator
	 *
	 * @var BowerGenerator
	 */
	protected $grunt;


	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(BowerGenerator $bower, GruntGenerator $grunt)
	{
		parent::__construct();

		$this->bower = $bower;
		$this->grunt = $grunt;

	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		//calculate file name and path, 

		$assets_path = $this->argument('assets_path');
		$bower_folder = $this->argument('bower_folder');
		// generate bower file. 
		// 
		if($this->bower->fileExists()){
			if(!$this->confirm('Bower files already exist, would you like to overwrite ? [y,n]', false)){
				$this->info('Bower Publish canceled!');
				return;

			}
			if(!$this->confirm('This will delete previous Bower files for this project from your assets, are you sure ? [y,n]', false)){
				$this->info('Bower Publish canceled!');
				return;

			}

			if($this->bower->cleanPreviousInstall()){
				$this->info('Previous Bower install folder was removed');

			}else{
				$this->info('Could not remove previous Bower install folder, please check your .bowerrc file directory path has not been modified.');
				return;

			}

			// should check to see if bower comps have been installed, then uninstall and clean the folder. 
			// 	

		}
		
	

		$this->bower->generate($assets_path, $bower_folder);
		$this->info('Bower files Published!');


		if($this->grunt->fileExists()){
			if(!$this->confirm('Grunt files already exist, would you like to overwrite ? [y,n]', false)){
				$this->info('Grunt Publish canceled!');
				return;

			}
			if(!$this->confirm('This will overwrite previous Grunt files for this project, are you sure ? [y,n]', false)){
				$this->info('Grunt Publish canceled!');
				return;

			}

		}

		$this->grunt->generate($assets_path, $bower_folder);
		$this->info('Grunt files Published!');



	}



	protected function askContinue($message)
	{
		if($this->confirm($message, $default))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('assets_path', InputArgument::REQUIRED, 'Path where you want you assets installed.'),
			array('bower_folder', InputArgument::REQUIRED, 'Folder name where Bower components will be installed.'),
		);
	}



}