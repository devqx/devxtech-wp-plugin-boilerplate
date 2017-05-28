<?php 
/**
 * Plugin Name: Auto Peer Donationg
 * Plugin URI: http://www.devstackng.com
 * Description: Automatic peer to peer Donation system 
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
    $pages = new Plugin_Pages();
    $pages->create_pages();

     $views = new View();


      $model = new Model();

     $users = new Users($model);

     $util = new Util($views,$users);


     $register = new Register($util,$model);

   

    $shortcodes = new Plugin_Shortcodes($views,$register,$util,$model);
    $shortcodes->shortcodes();

    $assets = new Assets();
    $assets->load_assets();

    $hooks = new Hooks($assets, $model);
    $hooks->add_actions();
    $hooks->add_filters();



}

function activate(){

    $model = new Model();

    $activator = new Activate($model);
    $activator->activate();
}

function deactivate(){
    $deactivator = new Deactivate();
    $deactivator->deactivate();

}



//register the plugin activation hooks 
register_activation_hook( __FILE__, 'activate' );

//register the plugin deactivation hooks 
register_deactivation_hook( __FILE__, 'deactivate' );


?>