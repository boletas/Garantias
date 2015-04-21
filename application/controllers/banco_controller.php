<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banco_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('banco_model');
        $this->load->library('session');
    }
    
    public function Index(){
        $que = $this->input->post("crud");
        if($que == "nuevo"){
            redirect(base_url()."?sec=nuevo_banco",'refresh');
        }
        
        if($que == "editar"){
            $idBanco = $this->input->post("cual");
            $this->DevuelveBanco($idBanco);
        }
        
        if($que == "eliminar"){
            $idBanco = $this->input->post("cual");
            $this->EliminaBanco($idBanco);
        }
    }
    
    public function DevuelveBanco($idBanco){
        $data = $this->banco_model->DevuelveBanco($idBanco);
        foreach($data as $row){
            $idBanco = $row->idBanco;
            $nombre_banco = $row->nombre_banco;
        }
        $banco = array(
            'idBanco'   => $idBanco,
            'banco'     => $nombre_banco
        );
        $this->session->set_userdata($banco);
        redirect(base_url()."?sec=edita_banco",'refresh');
    }
    
    public function NuevoBanco(){
        $banco = $this->input->post("nombre_banco");
        
        $data = $this->banco_model->ExisteBanco($banco);
        if($data){
            $this->session->set_flashdata('error', 'Ya existe un banco con el nombre indicado');
            redirect(base_url()."?sec=nuevo_banco",'refresh');
        }else{
            $data = $this->banco_model->NuevoBanco($banco);
            if($data){
                $this->session->set_flashdata('guardado', 'El banco fue guardado correctamente');
                redirect(base_url()."?sec=nuevo_banco",'refresh');
            }else{
                $this->session->set_flashdata('error', 'Ocurrio un problema al tratar de guardar el banco');
                redirect(base_url()."?sec=nuevo_banco",'refresh');
            }
        }
    }
    
    public function EditaBanco(){
        
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
