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

    public function query_payment(){
    session_start();
    if(!empty($_SESSION['cur_donator'])){
    /*--------------Begin Processing & payment verification-----------------*/
    ##Check if transaction ID has been submitted
    $merchant_id = 'demo';
    if(isset($_POST['transaction_id'])){
    //get the full transaction details as an json from voguepay
    $json = file_get_contents('https://voguepay.com/?v_transaction_id='.$_POST['transaction_id'].'&type=json&demo=true');
    //create new array to store our transaction detail
    $transaction = json_decode($json, true);


    $payer = explode("|" , $transaction['merchant_ref'])[1];

        if($transaction['status'] == 'Approved'){
        echo "<div class='alert-success col-md-8' style='margin:20px 0px'><p style='padding:5px;'>Your Payment Transaction Was successful, You can Now Access Your Dashboard</p></div>";
        $this->users->donator_to_receiver();
    

    }

    else {
         echo "<div class='alert-danger col-md-8' style='margin:20px 0px'><p style='padding:5px;'>Your Payment Transaction Was Unsuccessful</p></div>";
    }

    }
        }
    
 }


 }

?>