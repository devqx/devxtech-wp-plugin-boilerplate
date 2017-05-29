<?php 
/**
 * Plugin Name: Face Of Angels
 * Plugin URI: http://www.devstackng.com
 * Description: Premium Wordpress Plugin For the Fangs site 
 * Version: 1.0.0
 * Author: Oluwaseun Paul 
 * Author URI: http://www.devstackng.com 
 * License: MIT
 */

 ob_start();

//abort if the file is accessed directly 
if( !defined('WPINC') ){
    die;
}

require 'vendor/autoload.php';

use app\pages\Plugin_Pages;
use app\shortcodes\Plugin_Shortcodes;
use app\helpers\View;
use app\users\Users;
use app\hooks\Hooks;
use app\hooks\Activate;
use app\hooks\Deactivate;
use app\model\Model;
use app\auth\Register;
use app\helpers\Util;
use app\Assets\Assets;



add_action( 'init', 'init' );

function init(){

    //instantiate the pages class
    $pages = new Plugin_Pages();

    //create the pages 
    $pages->create_pages();

    //instantiate the View Class
    $views = new View();

     //instantiate the Model Class
    $model = new Model();

    //instantiate the User Class
    $users = new Users($model);

    //instantiate the Utility Class
    $util = new Util($views,$users);

    //instantiate the Registration  Class
    $register = new Register($util,$model);

    //instantiate the Shortcodes Class
    $shortcodes = new Plugin_Shortcodes($views,$register,$util,$model);

    //load the shortcodes 
    $shortcodes->shortcodes();

    //instantiate the Assets Class
    $assets = new Assets();

    //load all the assets
    $assets->load_assets();

    //instantiate the Hooks Class
    $hooks = new Hooks($assets, $model);

    //load all actions 
    $hooks->add_actions();

    //apply all filters 
    $hooks->add_filters();



}

function activate(){

    //instantiate the Model Class
    $model = new Model();

    // //instantiate the Activate Class and inject the Model class as a dependency 
    $activator = new Activate($model);

    //load the activate method
    $activator->activate();
}

function deactivate(){

    //instantiate the Deactivate Class
    $deactivator = new Deactivate();

    //load the deactivate method
    $deactivator->deactivate();

}



//register the plugin activation hooks 
register_activation_hook( __FILE__, 'activate' );

//register the plugin deactivation hooks 
register_deactivation_hook( __FILE__, 'deactivate' );


?>