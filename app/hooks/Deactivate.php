<?php 

/**
 *This class is responsible for defining methods 
 *to be called at plugin activation 
 *@since 1.0.0 
 */
 namespace app\hooks;

class Deactivate {

    public function __construct(){
        
    }

    public function deactivate(){

        //delete the created pages 
        $fange_pages = get_option('fang_pages', false);

        foreach($fange_pages as $pages){
            wp_delete_post($pages);
        }
    
    }

}

?>