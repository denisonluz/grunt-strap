This Laravel 4 package provides a quick way to integrate Twitter Bootstrap using Bower, and Grunt, into your Laravel app:

- `bbg:publish`
- `bbg:install`




## Installation

* 1 by installing this package through Composer. Edit your project's `composer.json` file to require `donovan/grunt-strap`.

	"require": {
		"laravel/framework": "4.0.*",
		"donovan/grunt-strap": "dev-master"
	},
	"minimum-stability" : "dev"


* 2 run composer update
 `composer update`



* 3 Open `app/config/app.php`, and add a new item to the providers array.

     'Donovan\GruntStrap\GruntStrapServiceProvider'

* 4 You should now be able to verify everything is installed by running

    `php artisan`
    
## Usage


- [bbg:publish](#publish)


### publish

This command publishes Bower and Grunt files into your project root. 

    php artisan bbg:publish [assets path] [bootstrap folder]
    
    
This command takes two parameters:

* **assets path**:  the location where your development assets will be located. This package copies over a few .js and .less files. 
 
* **bootstrap folder**:  the folder in your assets path where Bower should install all components. Please note, this package assumes this folder will be inside your assets path. 



####To give you an example, the following command 

	php artisan bbg:publish app/assets bootstrap_components
	
	
will create an **assets** folder inside your **app** folder, with sub-folders for many typical assets ( less, css, js, fonts, icons, images). 

![image](https://dl.dropboxusercontent.com/s/1e9wf6st8fv88pa/folder_assets.png)


this will also instruct **Bower** to install all components into the **app/assets/bower_components** folder. 

the **bootstrap** less file is now your new bootstrap manifest file to control which components of bootstrap to compile, as well as adding your own less files, mixins, and overriding bootstrap variables. 





