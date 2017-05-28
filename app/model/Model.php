<?php 

/**
 *This class is responsible for creating the database tables 
 *
 *@since 1.0.0 
 */
 namespace app\model;

class Model {

    public $donators_tbl;

    public $receivers_tbl;

    public $mponzi_users;


    public function __construct(){

    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $table_prefix = $wpdb->prefix;

    //donators table name 
    $this->donators_tbl = $table_prefix."mponzi_donators";

    //receivers table name 
    $this->receivers_tbl = $table_prefix."mponzi_receivers";


    //mponzi users table name 
    $this->mponzi_users = $table_prefix."mponzi_users";

    }

public function migrations(){
    // require the upgrade file to use dbDelta()
    require_once(ABSPATH.'/wp-admin/includes/upgrade.php');

    global $wpdb;

    //create donators table 
    $sql[] = "CREATE TABLE $this->donators_tbl (
        ID int(55) NOT NULL AUTO_INCREMENT,
        full_name varchar(55) DEFAULT '' NOT NULL,
        email varchar(55) DEFAULT '' NOT NULL ,
        user_login varchar(55) DEFAULT '' NOT NULL ,
        user_pwd varchar(55) DEFAULT '' NOT NULL ,
        account_name varchar(55) DEFAULT '' NOT NULL ,
        account_number varchar(55) DEFAULT '' NOT NULL,
        bank_name varchar(55) DEFAULT '' NOT NULL,
        phone_number varchar(55) DEFAULT '' NOT NULL,
        created_at DATETIME DEFAULT '0000-00-00 00:00:00',
        PRIMARY KEY  (ID)
        )$charset_collate;";

    //create receivers table 
    $sql[] = "CREATE TABLE $this->receivers_tbl (
        ID int(55) NOT NULL AUTO_INCREMENT,
        full_name varchar(55) DEFAULT '' NOT NULL,
        email varchar(55) DEFAULT '' NOT NULL ,
        user_login varchar(55) DEFAULT '' NOT NULL ,
        user_pwd varchar(55) DEFAULT '' NOT NULL ,
        account_name varchar(55) DEFAULT '' NOT NULL ,
        account_number varchar(55) DEFAULT '' NOT NULL,
        bank_name varchar(55) DEFAULT '' NOT NULL,
        phone_number varchar(55) DEFAULT '' NOT NULL,
        level varchar(55) DEFAULT '1' NOT NULL,
        created_at DATETIME DEFAULT '0000-00-00 00:00:00',
        count varchar(55) DEFAULT '' NOT NULL,
        amount varchar(55) DEFAULT '' NOT NULL,
        PRIMARY KEY  (ID)
        )$charset_collate;";



    //create general users table 
    $sql[] = "CREATE TABLE $this->mponzi_users (
        ID int(55) NOT NULL AUTO_INCREMENT,
        full_name varchar(55) DEFAULT '' NOT NULL,
        email varchar(55) DEFAULT '' NOT NULL ,
        user_login varchar(55) DEFAULT '' NOT NULL ,
        user_pwd varchar(55) DEFAULT '' NOT NULL ,
        account_name varchar(55) DEFAULT '' NOT NULL ,
        account_number varchar(55) DEFAULT '' NOT NULL,
        bank_name varchar(55) DEFAULT '' NOT NULL,
        role varchar(55) DEFAULT '' NOT NULL,
        phone_number varchar(55) DEFAULT '' NOT NULL,
        payment_status varchar(55) DEFAULT '' NOT NULL,
        PRIMARY KEY  (ID)
        )$charset_collate;";
    


//execute the querries 
    dbDelta($sql);
    
}



}

?>