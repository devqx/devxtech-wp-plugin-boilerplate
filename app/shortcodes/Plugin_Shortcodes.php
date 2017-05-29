<?php 


/** 
 *class for rendering all shortcodes in the plugin 
 *@since 1.0.0
 *@author oluwaseun paul <devqxz@gmail.com>
 */

 namespace app\shortcodes;

 class Plugin_Shortcodes {
      /** 
       *@var $views holds an instance of the View class
       */
      private $views;

        /** 
       *@var $views holds an instance of the Utility class
       */
      private $util;

      /** 
       *@var $register holds an instance of the register class
       */
      private $register;

        /** 
       *@var $model holds an instance of the model class
       */
      
      private $model;

     public function __construct($view,$register,$util, $model){
        $this->view = $view;
        $this->register = $register;
        $this->util = $util;
        $this->model = $model;
     }

     /**
     *@return the added shortcodes 
     */

     public function shortcodes(){
       add_shortcode('fang-user-register', array($this, 'render_new_member_register'));
       add_shortcode('fang-user-login', array($this, 'render_member_login'));


     }

     public function render_new_member_register(){
        $this->util->redirect_logged_user();
        $this->view->load_view('member_register');
        $this->register->register($this->model->donators_tbl, 0);
        
     }

      public function render_member_login(){
         $this->util->redirect_logged_user();
          $this->util->query_payment();
          $this->view->load_view('member_login');
        
     }
      

 }


?>