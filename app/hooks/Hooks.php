<?php 

/**
 * This class adds hooks ( actions and filters needed by the plugin )
 *
 *@since 1.0.0 
 */

 namespace app\hooks;

 class Hooks {
     
     public  $assets;

     public $model;

     private $redirect_url;

     public function __construct($assets, $model){

         $this->assets = $assets;
         $this->model = $model;

     }

     public function add_actions(){
        add_action('wp_head', array($this, 'custom_styles'));
        add_action('login_form_register', array($this, 'custom_redirect'));
        add_action('login_form_login', array($this, 'login_redirect'));
        
        
     }

     public function add_filters(){
         add_filter('authenticate', array($this, 'check_auth_errors' ),101,3);
         add_filter( 'login_redirect', array($this, 'auth_login_redirect'), 10, 3 );

     }

     public function custom_redirect(){

        //redirect user from wp-login.php?action='register' to /registration 
         if("GET" === $_SERVER['REQUEST_METHOD']){
             wp_redirect(home_url('registration'));
         }
        

     }

     //redirect user from wp-login.php? to /login
      public function login_redirect(){       
         if("GET" === $_SERVER['REQUEST_METHOD']){
             wp_redirect(home_url('login'));
         }
        
     }

     public function auth_login_redirect($redirect_to, $request, $user){
       /**
        * Redirect user after successful login.
        *
        * @param string $redirect_to URL to redirect to.
        * @param string $request URL the user is coming from.
        * @param object $user Logged user's data.
        * @return string
        */
            //is there a user to check?
            if ( isset( $user->roles ) && is_array( $user->roles ) ) {
                //check for admins
                if ( in_array( 'administrator', $user->roles ) ) {
                    // redirect them to the default place
                    return $redirect_to;
                } else {
                    return home_url('member-dashboard');
            }

        } else {
            return $redirect_to;
        }
     }


     public function check_auth_errors($user,$username,$password){
         if("POST"===$_SERVER['REQUEST_METHOD']){
             if(is_wp_error($user)){
                $this->redirect_url = add_query_arg('login_errors', join(',',$user->get_error_codes()), home_url('login'));
                 wp_redirect($this->redirect_url);
                 exit;
             }
         }

        return $user;

     }  

     public function custom_styles(){
         echo "<style>input[type=text],input[type=password],input[type=email]{ height:3em;}</style>";
     }


 }

?>