<?php namespace Donovan\GruntStart\Commands;


use Illuminate\Filesystem\Filesystem;


class BowerGenerator {


	protected $file;

	protected $bower_rc;

	protected $bower_json;

	
	public function __construct(Filesystem $file){

		$this->file = $file;


		$this->bower_rc = base_path().'/.bowerrc';

		$this->bower_json = base_path().'/bower.json';

	}
	public function generate($path, $bower_folder){

		$this->createBowerRcFile($path, $bower_folder);
		$this->createBowerJsonFile();
	
	}

	public function fileExists(){

		if( $this->file->exists($this->bower_rc) || $this->file->exists($this->bower_json))
			return true;

		return false;	
	}
	public function cleanPreviousInstall(){

	
		// read the previous .bowerrc file and get the directory path
		$content = json_decode($this->file->get($this->bower_rc), true);

		if( isset( $content['directory'] ) ){
			$path = base_path().'/'.$content['directory'];
			//dd($path);
			$this->file->deleteDirectory($path );
   			return true;

   		}
   		return false;
	
	}

	private function createBowerRcFile($path, $bower_folder){
	
		
		$template = $this->file->get(__DIR__.'/templates/bowerrc.txt');
		$this->file->put($this->bower_rc, str_replace("{{FOLDER}}", '"'.$path.'/'.$bower_folder.'"', $template));

	}
	private function createBowerJsonFile(){

		$template = $this->file->get(__DIR__.'/templates/bower.txt');
		$this->file->put($this->bower_json, $template);


	}
	
	


}