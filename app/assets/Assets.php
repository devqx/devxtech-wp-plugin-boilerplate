<?php 

namespace app\assets;

/**
 *@since 1.0.0 
 * Class responsible for loading assets , stylesheets, scripts 
 */

 class Assets {

    /**
     *@var styles array of all the styles needed 
     */

     private $styles;

     /**
     *@var styles array of all the styles needed 
     */
     public $scripts;

     public function __construct(){

        $this->scripts = array();
        $this->styles = array();
     }

     /**
     *@return  array of styles
     */

     public function add_styles(){


     }

     public function add_scripts(){
    
    $this->scripts = $this->add($this->scripts,'mponzi_js', plugin_dir_url( dirname(__FILE__) ).'assets/js/mponzi.js', array("jquery"), '1.0', true );
  
        
     }

     public function add($assets,$handle, $src,$deps,$version,$in_footer ){

        $assets[] = array(
            'handle'=>$handle,
            'src'=>$src,
            'deps'=>$deps,
            'version'=>$version,
            'in_footer'=>$in_footer
        );

        return $assets;
         
     }

     public function load_assets(){
        
        $this->add_scripts();
        //load all the styles 
         //foreach(styles as $style){
             //wp_enqueue_style($style['handle'], $style['src'], $style['deps'], $style['media']);
         //}

        //load all the scripts 
        foreach($this->scripts as $script){
        wp_enqueue_script( $script['handle'], $script['src'], $script['deps'],$script['version'], $script['in_footer'] );
        }


     }




  


 }

?>