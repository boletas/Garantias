<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('datos_persona');
    }
    
    public function Inicio_Sesion(){
        $usuario = $this->input->post("usuario");
        $pass = $this->input->post("password");
        
        $data = $this->login_model->login_user($usuario,$pass);
        if(!empty($data)){
            if ($data->num_rows() > 0){
                $this->datos_persona->Persona($data->row('idUsuario'),'login');
            }else{
                $this->session->set_flashdata('usuario_incorrecto','Usuario o contraseña incorrecto');
                redirect('plantilla_controller');
            }
        }else{
            $this->session->set_flashdata('usuario_incorrecto','Usuario o contraseña incorrecto');
            redirect('plantilla_controller');
        }
    }
}