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
            }
        
            /*if($usuariook == TRUE){
                $data = array (
                    'logueado'          => TRUE,
                    'perfil'            => $usuariook->perfil,
                    'usuario'           => $usuariook->nombre,
                    'ap_paterno'        => $usuariook->ap_paterno,
                    'ap_materno'        => $usuariook->ap_materno,
                    'nombre_usuario'    => $usuariook->nombre_usuario,
                    'pass_usuario'      => $usuariook->pass_usuario
                );
                //Se pasan los datos del array $data a la sesion
                $this->session->set_userdata($data);*/
                //redirect(base_url()."?sec=Inicio",'refresh');
            
            else{
                $this->session->set_flashdata('usuario_incorrecto','Usuario o contraseña incorrecto');
                redirect('plantilla_controller');
            }
        }else{
            $this->session->set_flashdata('usuario_incorrecto','Usuario o contraseña incorrecto');
            redirect('plantilla_controller');
        }
    }
}