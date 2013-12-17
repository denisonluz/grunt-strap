# STILL IN DEVELOPMENT


### Grunt-Strap(Grunt - Bower, Bootstrap)

This package provides a quick way to integrate Twitter Bootstrap using Bower, and Grunt, into your Laravel app. 


This package will create an assets folder structure containing a few place holder files to get everything started. It uses the LESS files from Bootstrap and gets compiled in using Grunt. It's not super flexible (yet), you provide an assests path and folder name for Bower to dump depends it spits out folders and files for you. 
 


- `bbg:publish`
- `bbg:install`

more coming 
grunt, watch, publish public, etc. 


## Installation


This package assumes you have Grunt cli already installed. See [Installing Grunt](http://gruntjs.com/getting-started) before proceeding. 


* Install this package through Composer. Edit your project's `composer.json` file to require `donovan/grunt-strap`.

		"require": {
			"laravel/framework": "4.0.*",
			"donovan/grunt-strap": "dev-master"
		},
		"minimum-stability" : "dev"


* run composer update
 `composer update`



* Open `app/config/app.php`, and add a new item to the providers array.

		'Donovan\GruntStrap\GruntStrapServiceProvider'

* You should now be able to verify everything is installed by running `php artisan` and verify there are the `bbg` commands listed at the top. 
    
## Usage

Run the artisan command from the project root. 

- [bbg:publish](#publish)
- [bbg:install](#install)


### publish

This command publishes Bower and Grunt files into your project root. 

    php artisan bbg:publish [assets path] [bower folder]
    
    
This command takes two parameters:

* **assets path**:  the location where your development assets will be located. This package copies over a few .js and .less files to get things started. 


 
* **bower folder**:  the folder in your assets path where Bower should install all components. Please note, this package will place this folder inside your assets path. 



####To give you an example, the following command 

	php artisan bbg:publish app/assets bower_components
	
	
will create an **assets** folder inside your **app** folder, with sub-folders for many typical assets ( less, css, js, fonts, icons, images). 

![image](https://dl.dropboxusercontent.com/s/1e9wf6st8fv88pa/folder_assets.png)


this will also instruct **Bower** to install all components into the **app/assets/bower_components** folder. 

the **bootstrap.less** file is now your new bootstrap manifest file to control which components of bootstrap to compile, as well as adding your own less files, mixins, and overriding bootstrap variables. 

You don't have to keep these file names but if you do change them you'll need to also change the published Grunt.js file. 



### install


	php artisan bbg:install

This command will run the following sequences of commands in the order shown below. 
 

	

	bower install
Installs the bower components, (Bootstrap and Font-awesome)

	sudo npm install
	
Installs Grunt and all the Grunt dependencies using npm.  


	grunt

Runs the generated grunt.js script for the first time to populate our dist and public folders. 



## What next  ?

Once you have installed this package and ran the publish and install commands, you can run grunt directly from the command line. 

Grunt and Grunt Watch will both build all the assets and place them in the /dist folder,  THEN copy them to the public/assets folder. 





