<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Mantenedor extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('banco_model');
    }
    
    public function ObtieneBancos(){
        
        $data = $this->banco_model->ObtieneBancos();
        if(!empty($data)){
            if ($data){
                return $data;
            }
        }
    }
    
    
    
    
}