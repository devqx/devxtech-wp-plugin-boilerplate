<?php 

/**
 * Users class for the plugin
 *@since 1.0.0
 */

namespace app\users;

class Users {

    /**
     * @var an instance of the model class 
     */
    private $model;

    public function __construct($model){
        $this->model = $model;
    }

    public function donator_to_receiver(){

        //globalize $wpdb to interact with the wordpress databas 
         global $wpdb; 

         //start session to get the sessioned user
        session_start();
        
        //set default time zone to get current time
        date_default_timezone_set('Africa/Lagos');

        //get the donator who just paid 
        $paid_user = $_SESSION['cur_donator'];
        
       // echo $paid_user;

        $receivers_tbl = $this->model->receivers_tbl;

        $donators_tbl = $this->model->donators_tbl;

        $mponzi_users_tbl = $this->model->mponzi_users;

        //give the payment to a receiver due to collect 

        $due_receiver = "SELECT * FROM $receivers_tbl ORDER BY created_at DESC LIMIT 1";
        $receiver_query = $wpdb->get_results($due_receiver, ARRAY_A);
        foreach($receiver_query as $receiver_details){
          $user_level = $receiver_details['level'];
           $cur_amount = $receiver_details['amount'];
           $count = $receiver_details['count'];
        }
        
        var_export($count);
        $receiver_username = $receiver_details['user_login'];
            switch($user_level){
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

            }


        //get the donators details
        $donator_details = "SELECT * FROM $donators_tbl WHERE user_login='$paid_user' ";
        $donator_info = $wpdb->get_row($donator_details, ARRAY_A);  
        
        //insert the donator as a receiver  
        $new_receiver_data = [
            'full_name'=>$donator_info['full_name'],
            'email'=>$donator_info['email'],
            'user_login'=>$donator_info['user_login'],
            'user_pwd'=>md5($donator_info['user_pwd']),
            'account_name'=>$donator_info['account_name'],
            'account_number'=>$donator_info['account_number'],
            'bank_name'=>$donator_info['bank_name'],
            'phone_number'=>$donator_info['phone_number'],
            'level'=>1,
            'created_at'=>date('Y-m-d H:i:s')
        ];

        $wpdb->insert($receivers_tbl, $new_receiver_data);

        //update the user in the general
        $user_update = "UPDATE $mponzi_users_tbl SET role='receiver' , payment_status='1' WHERE user_login='$paid_user' ";
        
        $wpdb->query($user_update);

        //clean up the donator from the donators table 
        $delete_donator = "DELETE FROM $donators_tbl WHERE user_login='$paid_user' ";
        $wpdb->query($delete_donator);

        //remove the sessioned user 
        unset($_SESSION['cur_donator']);
        session_destroy();
        

    }
}