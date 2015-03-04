<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('login_model');
    }
    
    public function Inicio_Sesion(){
        $usuario = $this->input->post("usuario");
        $pass = $this->input->post("password");
        $usuariook = $this->login_model->login_user($usuario,$pass);
            //consulta si se hizo la consulta (para soncultar..?) XD //si wn SONCULTAR JAJA
            if($usuariook == TRUE){
                $data = array (
                    'logueado'      => TRUE,
                    'perfil'        => $usuariook->perfil,
                    'usuario'       => $usuariook->nombre,
                    'ap_paterno'    => $usuariook->ap_paterno
                );
                //Se pasan los datos del array $data a la sesion
                $this->session->set_userdata($data);
                redirect(base_url()."?sec=Inicio",'refresh');
            }else{
                redirect(base_url()."?sec=Inicio",'refresh');
            }
    }
}