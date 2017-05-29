<?php 

/**
*This is class is responsible for handling users registration
*
* @since 
*/
namespace app\auth;

 class Register {
    /**
    *@var $request an associative array of $_POST vars 
    */
     private $request;

       /**
    *@var $register_url url of the registration page
    */
     private $register_url;

    /**
    *@var $db_save , response from the database;
    */
     private $user;

    /**
    *@var $user_data , array of users information to insert the user into wordpress db
    */
     private $user_data;

    /**
    *@var $user_id , id of the new created user from wp_insert_user;
    */
     private $user_id;

    /**
    *@var $error_url redirect url when there are registration errors 
    */
     private $redirect_url;

     /**
      * @var $util  an instance of the utility class
      */

    private $util;


       /**
      * @var $util  an instance of the model class
      */

      private $model;

public function __construct($util, $model){
    $this->util = $util;
    $this->model = $model;
}

public function register(){

    $fang_users_tbl = $this->model->fang_users;

    if(isset($_POST['submit']) && !empty($_POST['submit'])){
        foreach($_POST as $key=>$val){
            $this->request[$key] = $val;
        }

        //insert the user into wordpress database table 

        $this->user_data = array(
            'user_login'=>$this->request['username'],
            'user_pass'=>$this->request['password'],
            'user_email'=>$this->request['email'],
            'display_name'=>$this->request['full_name']
        );

        //call the wordpress Api for inserting users : wp_insert_user
        /**
         *@return $user_id on success, wp_error object on failure 
         */
         $this->user_id = wp_insert_user($this->user_data);
         $this->redirect_url = home_url('registration');

          //if error , redirect back 

         if($errors = is_wp_error($this->user_id)){
            $error_url = home_url('registration');
            $this->redirect_url = add_query_arg('auth', 'errors',$error_url );
               
         }

       else {

        //save the user details to the db
        global $wpdb;

        //set default timezone
         date_default_timezone_set('Africa/Lagos');

        //save the incoming donator
        $this->user = $wpdb->insert(
         $fang_users_tbl, array(
            'full_name'=>$this->request['full_name'],
            'email'=>$this->request['email'],
            'user_login'=>$this->request['username'],
            'user_pwd'=>md5($this->request['password']),
            'account_name'=>$this->request['account_name'],
            'account_number'=>$this->request['account_number'],
            'bank_name'=>$this->request['bank_name'],
            'phone_number'=>$this->request['phone_number'],
            'created_at'=>date('Y-m-d H:i:s'),

         )
        
        );

      
        $success_url = home_url('payment-page');
        $this->redirect_url = add_query_arg('Register', 'successful', $success_url);
    }

    }

    wp_redirect($this->redirect_url);
     
}

     
 }