<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banco_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('banco_model');
        $this->load->helper('form');
        $this->load->library('session');
    }
    
    public function Index(){
        $que = $this->input->post("crud");
        if($que == "nuevo"){
            
        }
        
        if($que == "editar"){
            $idBanco = $this->input->post("cual");
            $this->EditaBanco($idBanco);
        }
        
        if($que == "eliminar"){
            $idBanco = $this->input->post("cual");
            $this->EliminaBanco($idBanco);
        }
    }
    
    public function ExisteBanco(){
    
    }
    
    public function NuevoBanco(){
    
    }
    
    public function EditaBanco($idBanco){
        
    }
    
    public function EliminaBanco($idBanco){
        $data = $this->banco_model->EliminaBanco($idBanco);
        if($data){
            $this->session->set_userdata('banco_ok','El registro fue eliminado correctamente');
            redirect(base_url()."?sec=banco",'refresh');
        }else{
            $this->session->set_userdata('banco_error','Ocurrio un problema al eliminar el registro');
            redirect(base_url()."?sec=banco",'refresh');
        }
    }
}
