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
       add_shortcode('new-member-register', array($this, 'render_new_member_register'));
       add_shortcode('member-login', array($this, 'render_member_login'));
       add_shortcode('member-dashboard', array($this, 'render_member_dashboard'));
       add_shortcode('payment-page', array($this, 'render_payment_page')); 
       add_shortcode( 'admin-add-receiver', array($this, 'render_admin_add_receiver') );

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

     public function render_member_dashboard(){
        //get current logged in username 
         $logged_user = wp_get_current_user();
         $user_login = $logged_user->user_login;
         global $wpdb;

         //get logged in user level 
         $receivers_tbl = $this->model->receivers_tbl;
         $user_level = "SELECT level FROM $receivers_tbl WHERE user_login='$user_login'";
         $level = $wpdb->get_var($user_level);
         $data['user_level'] = $level;

         //get logged in user balance 
         $user_amt_query= "SELECT amount FROM $receivers_tbl WHERE user_login='$user_login'";
         $user_amount = $wpdb->get_var($user_amt_query);


         $mponzi_users = $this->model->mponzi_users;
         $check_payment_status = "SELECT payment_status FROM $mponzi_users WHERE user_login='$user_login' ";
         $payment_status = $wpdb->get_var($check_payment_status);
         //echo $payment_status;
         if($payment_status == 0){
           wp_logout();
           $payment_page = home_url('payment-page');
           wp_redirect( $payment_page);
         }
         $data['user_login'] = $user_login;
         $data['user_amt'] = $user_amount;

        //load the member dashboard view 
        $this->view->load_view('member_dashboard', $data);

        //testing 

        $due_receiver = "SELECT * FROM $receivers_tbl ORDER BY created_at DESC LIMIT 1";
        $receiver_query = $wpdb->get_results($due_receiver, ARRAY_A);
        foreach($receiver_query as $receiver_details){
          $user_level = $receiver_details['level'];
           $cur_amount = $receiver_details['amount'];
           $count = $receiver_details['count'];
        }
        
        //var_export($count);
        $receiver_username = $receiver_details['user_login'];
            switch($user_level){
              //if user is in level 1
                case '1':
                if( $count <=2 ){
                   
                    //set the new amount 
                    $update_amount = $cur_amount + 5000 ;
                
                  //increment the count as well 
                   $new_count = $count + 1 ;

                  $amt_update = "UPDATE $receivers_tbl SET amount='$update_amount' , count='$new_count' WHERE user_login='$receiver_username' " ;
                  $wpdb->query($amt_update);
                }
                break;

              //if user is in level 2 

               case '2':
                if( $count <=5 ){
                   
                    //set the new amount 
                    $update_amount = $cur_amount + 5000 ;
                
                  //increment the count as well 
                   $new_count = $count + 1 ;

                  $amt_update = "UPDATE $receivers_tbl SET amount='$update_amount' , count='$new_count' WHERE user_login='$receiver_username' " ;
                  $wpdb->query($amt_update);
                }
                break;


                //if user is in level 3
               case '3':
                if( $count <=11 ){
                   
                    //set the new amount 
                    $update_amount = $cur_amount + 5000 ;
                
                  //increment the count as well 
                   $new_count = $count + 1 ;

                  $amt_update = "UPDATE $receivers_tbl SET amount='$update_amount' , count='$new_count' WHERE user_login='$receiver_username' " ;
                  $wpdb->query($amt_update);
                }
                break;


                //if user is in level 4
               case '4':
                if( $count <=23 ){
                   
                    //set the new amount 
                    $update_amount = $cur_amount + 5000 ;
                
                  //increment the count as well 
                   $new_count = $count + 1 ;

                  $amt_update = "UPDATE $receivers_tbl SET amount='$update_amount' , count='$new_count' WHERE user_login='$receiver_username' " ;
                  $wpdb->query($amt_update);
                }
                break;


                 //if user is in level 5
               case '5':
                if( $count <=49 ){
                   
                    //set the new amount 
                    $update_amount = $cur_amount + 5000 ;
                
                  //increment the count as well 
                   $new_count = $count + 1 ;

                  $amt_update = "UPDATE $receivers_tbl SET amount='$update_amount' , count='$new_count' WHERE user_login='$receiver_username' " ;
                  $wpdb->query($amt_update);
                }
                break;

                  //if user is in level 6
               case '6':
                if( $count <=149 ){
                   
                    //set the new amount 
                    $update_amount = $cur_amount + 5000 ;
                
                  //increment the count as well 
                   $new_count = $count + 1 ;

                  $amt_update = "UPDATE $receivers_tbl SET amount='$update_amount' , count='$new_count' WHERE user_login='$receiver_username' " ;
                  $wpdb->query($amt_update);
                }
                break;

            }


            

        
     }

     public function render_payment_page($data){
       $this->view->load_view('payment_form', $data);
     }

    public function render_admin_add_receiver($data){
      $this->view->load_view('admin_add_receiver', $data);
      $this->register->register($this->model->receivers_tbl, 1);
    }


 }


?>