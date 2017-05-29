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

   
}