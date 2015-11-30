<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actualiza_Perfil_Controller extends MY_Mantenedor {
    public function __construct(){
        parent::__construct();
        $this->load->model('actualiza_perfil_model');
        $this->load->library('datos_persona');
        $this->check_login();
    }
    
    public function Actualiza_Usuario(){
        $usuario = array(
            'nombre'        => $this->input->post("nombre"),
            'idUsuario'     => $this->input->post("idUsuario"),
            'ap_paterno'    => $this->input->post("ap_paterno"),
            'ap_materno'    => $this->input->post("ap_materno")
        );
        
        $data = $this->actualiza_perfil_model->Actualiza_Usuario($usuario);
        if(!empty($data)){
            if ($data){
                $this->datos_persona->Persona($this->input->post('idUsuario'),'actualiza');
            }else{
                $this->session->set_flashdata('actualiza','Ocurrio un error al actualizar los datos, favor intente mas tarde');
                redirect(base_url()."index.php/plantilla_controller/?sec=perfil_usuario",'refresh');
            }
        }else{
            $this->session->set_flashdata('actualiza','Ocurrio un error al actualizar los datos, favor intente mas tarde');
            redirect(base_url()."index.php/plantilla_controller/?sec=perfil_usuario",'refresh');
        }
    }
    
    public function Actualiza_Login(){
        
        if($this->session->userdata('pass_usuario') != $this->input->post("pass_usuario_antigua")){
            $this->session->set_flashdata('actualiza','Contraseña anterior no corresponde, intente nuevamente');
            redirect(base_url()."index.php/plantilla_controller/?sec=configuracion_usuario",'refresh');
        }else if($this->input->post("pass_usuario_uno") != $this->input->post("pass_usuario_dos")){
            $this->session->set_flashdata('actualiza','Las contraseñas deben ser iguales para ser actualizadas');
            redirect(base_url()."index.php/plantilla_controller/?sec=configuracion_usuario",'refresh');
        }else{
            $login = array (
                'nombre_usuario'        => $this->input->post("nombre_usuario"),
                'idPerfil'              => $this->input->post("idPerfil"),
                'pass_usuario_antigua'  => $this->input->post("pass_usuario_antigua"),
                'pass_usuario_uno'      => $this->input->post("pass_usuario_uno"),
                'pass_usuario_dos'      => $this->input->post("pass_usuario_dos")
            );
            $data = $this->actualiza_perfil_model->Actualiza_Login($login);
            if(!empty($data)){
                if($data){
                    $this->datos_persona->Persona($this->session->userdata('idUsuario'),'actualiza_login');
                }else{
                    $this->session->set_flashdata('actualiza','Ocurrio un error al actualizar los datos, favor intente mas tarde');
                    redirect(base_url()."index.php/plantilla_controller/?sec=configuracion_usuario",'refresh');
                }
            }else{
                $this->session->set_flashdata('actualiza','Ocurrio un error al actualizar los datos, favor intente mas tarde');
                redirect(base_url()."index.php/plantilla_controller/?sec=configuracion_usuario",'refresh');
            }
        }
    }
}