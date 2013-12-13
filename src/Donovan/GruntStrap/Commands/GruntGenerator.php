<?php namespace Donovan\GruntStrap\Commands;


use Illuminate\Filesystem\Filesystem;


class GruntGenerator {


	protected $file;

	protected $gruntFile;

	protected $packageFile;



	
	public function __construct(Filesystem $file){

		$this->file = $file;


		$this->gruntFile = base_path().'/Gruntfile.js';

		$this->packageFile = base_path().'/package.json';


	}
	public function generate($path, $bower_folder){

		$this->makeFolders($path, $bower_folder);
		$this->createGruntFile($path, $bower_folder);
		$this->createPackageJsonFile();
		
	
	}

	public function fileExists(){

		if( $this->file->exists($this->gruntFile) || $this->file->exists($this->packageFile))
			return true;

		return false;	
	}
	public function cleanPreviousInstall(){

	
		return true;
	
	}



	private function makeFolders($path, $bower_folder){

		// make all the assets folders. 

		// would be nice to do something like Grunt-init and use a rename.json file 
		// to indicate what folders inside the templates folder should be copied, the 
		// destination, as well as renames. 

		
		$this->file->copyDirectory(__DIR__.'/templates/less',$path.'/less');
		$this->copyBootstrapTemplate($path, $bower_folder); // only copy the template sample if the folder was empty
		$this->file->copyDirectory(__DIR__.'/templates/js',$path.'/js');
		$this->file->copyDirectory(__DIR__.'/templates/css',$path.'/css');
		$this->file->copyDirectory(__DIR__.'/templates/ico',$path.'/ico');
		$this->file->copyDirectory(__DIR__.'/templates/images',$path.'/images');
		$this->file->copyDirectory(__DIR__.'/templates/fonts',$path.'/fonts');
		
			
	}

	private function copyBootstrapTemplate($path, $bower_folder){

		$template = $this->file->get(__DIR__.'/templates/less/bootstrap.less');


		
		//$template = str_replace("{{BOOTSTRAP_FOLDER}}", $bower_folder.'/bootstrap', $template);


		$template = str_replace('@import "', '@import "../'.$bower_folder.'/bootstrap/less/', $template);

		$this->file->put($path.'/less/bootstrap.less',$template );

		//$this->file->copy($path,__DIR__.'/templates/less/sample.less');

	}
	private function createGruntFile($path, $bower_folder){
	
		
		$template = $this->file->get(__DIR__.'/templates/gruntfile.txt');
		$template = str_replace("{{ASSETS_FOLDER}}", '"'.$path.'/"', $template);

		$bootstrap_path = '"'.$path.'/'.$bower_folder .'/bootstrap/"';
		if(isset($bootstrap_path)){

			$template = str_replace("{{BOOTSTRAP_FOLDER}}", $bootstrap_path, $template);
		}
		
		$this->file->put($this->gruntFile,$template );

	}
	private function createPackageJsonFile(){

		$template = $this->file->get(__DIR__.'/templates/package.txt');
		$this->file->put($this->packageFile, $template);


	}
	
	


}