<?php 

/**
 * Utilities class for the plugin , run some errands 
 *@since 1.0.0
 */

namespace app\helpers;


 class Util{

     private $view;

     public function __construct($view,$users){
        $this->view = $view;
        $this->users = $users;
     }

     /**
      * Redirect current visitor
      *
      * @since 1.0.0
      **/

     public function redirect_logged_user(){
        if(is_user_logged_in()){
            wp_redirect(home_url('member-dashboard'));
        }
     }


 }

?>