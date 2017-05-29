<?php 

/**
 *This class is responsible for creating the database tables 
 *
 *@since 1.0.0 
 */
 namespace app\model;

class Model {

    public $fang_users;


    public function __construct(){

    global $wpdb;

    //get db charset 
    $charset_collate = $wpdb->get_charset_collate();

    //get the table prefix
    $table_prefix = $wpdb->prefix;

    //donators table name 
    $this->fang_users = $table_prefix."fang_users";

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
        account_name varchar(55) DEFAULT '' NOT NULL ,
        account_number varchar(55) DEFAULT '' NOT NULL,
        bank_name varchar(55) DEFAULT '' NOT NULL,
        phone_number varchar(55) DEFAULT '' NOT NULL,
        state varchar(55) DEFAULT '' NOT NULL, 
        wallet_balance varchar(55) DEFAULT '' NOT NULL,
        likes_balance varchar(55) DEFAULT '' NOT NULL, 
        total_likes varchar(55) DEFAULT '' NOT NULL,
        created_at DATETIME DEFAULT '0000-00-00 00:00:00',
        PRIMARY KEY  (ID)
        )$charset_collate;";

        //execute the querries 
            dbDelta($sql);
    
}



}

?>