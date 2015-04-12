<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banco_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('banco_model');
        $this->load->library('session');
    }
    
    public function index(){
        if($this->input->post("enviar") == "nuevo_banco"){
            $nuevo_banco = array(
                'nombre_banco' => $this->input->post("nombre_banco")
            );
            if($this->input->post("confirmado") == "si"){
                $this->NuevoBanco($nuevo_banco);
            }elseif($this->input->post("confirmado") == "no"){
                $estado = array(
                    'encontrado'    => '',
                    'nombre_banco'  => '',
                    'insertado'     => ''
                );
                $this->session->set_userdata($estado);
                redirect(base_url()."?sec=banco",'refresh');
            }else{
                $this->ExisteBanco($nuevo_banco);
            }
        }
    }
    
    function ExisteBanco($nuevo_banco){
        $data = $this->banco_model->ExisteBanco($nuevo_banco);
        if($data){
            if ($data->num_rows() > 0){
                $estado = array(
                    'select'        => '2',
                    'encontrado'    => 'si',
                    'nombre_banco'  => $nuevo_banco['nombre_banco']
                );
                $this->session->set_userdata($estado);
                redirect(base_url()."?sec=banco",'refresh');
            }
        }else{
            $this->NuevoBanco($nuevo_banco);
        }
    }
    
    public function NuevoBanco($nuevo_banco){
        $data = $this->banco_model->NuevoBanco($nuevo_banco);
        if($data){
            $estado = array(
                    'select'        => '2',
                    'insertado'     => 'si'
                );
            $this->session->set_userdata($estado);
            $estado = array(
                    'nombre_banco'  => '',
                    'encontrado'    => '',
                    'nombre_banco'  => ''
            );
            $this->session->unset_userdata($estado);
            redirect(base_url()."?sec=banco",'refresh');
        }
    }
}
