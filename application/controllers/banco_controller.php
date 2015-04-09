<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banco_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('banco_model');
        $this->load->library('session');
    }
    
    public function ObtieneBancos(){
        
        $data = $this->banco_model->ObtieneBancos();
        if(!empty($data)){
            if ($data){
                //$this->input->post($data);
                redirect(base_url()."?sec=banco",'refresh');
            }
        }
    }
    
}
