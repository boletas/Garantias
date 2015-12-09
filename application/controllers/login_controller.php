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
        
        $this->form_validation->set_rules('usuario', 'Nombre de usuario','trim|required|min_length[5]|xss_clean|valid_base64');
        $this->form_validation->set_rules('password','contraseña','trim|required|min_length[5]|xss_clean|valid_base64');
        
        $this->form_validation->set_message('required','El campo %s es obligatorio');
        $this->form_validation->set_message('min_length','El campo %s debe tener minimo 5 caracteres');
        $this->form_validation->set_message('valid_base64','El campo %s contiene caracteres invalidos');
        
        if($this->form_validation->run() == FALSE){
            $mensaje = validation_errors();
            $this->session->set_userdata('login',$mensaje);
            redirect('plantilla_controller');
        }else{
            $data = $this->login_model->login_user($usuario,$pass);
            if(!empty($data)){
                if ($data->num_rows() > 0){
                    $this->datos_persona->Persona($data->row('idUsuario'),'login');
                }
            }else{
                $mensaje = 'Usuario o contraseña incorrectos';
                $this->session->set_userdata('login',$mensaje);
                redirect('plantilla_controller');
            }
        }
    }
}