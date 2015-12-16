<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Datos_Persona{

    function Persona($id,$que){
        $CI =& get_instance();  
        $CI->load->model('persona_model');
        $CI->load->library('session');
       
        $datos = $CI->persona_model->ObtienePersona($id);
        if ($datos->num_rows() > 0){
            $data = array (
                    'logueado'          => TRUE,
                    'idUsuario'         => $datos->row('idUsuario'),
                    'usuario'           => $datos->row('nombre'),
                    'ap_paterno'        => $datos->row('ap_paterno'),
                    'ap_materno'        => $datos->row('ap_materno'),
                    'idPerfil'          => $datos->row('idPerfil'),
                    'perfil'            => $datos->row('perfil'),
                    'idLogin'           => $datos->row('idLogin'),
                    'nombre_usuario'    => $datos->row('nombre_usuario'),
                    'pass_usuario'      => $datos->row('pass_usuario')
            );
            if($que == "login"){
                $CI->session->set_userdata($data);
                redirect('plantilla_controller');
            }
            if($que == "actualiza"){
                $unset_usuario = array('usuario' => '', 'ap_paterno' => '', 'ap_materno' => '');
                $CI->session->unset_userdata($unset_usuario);
                $CI->session->set_userdata($data);
                $CI->session->set_flashdata('actualiza','Los datos fueron actualizados correctamente');
                redirect(base_url()."index.php/plantilla_controller/?sec=perfil_usuario",'refresh');
            }
            if($que == "actualiza_login"){
                $unset_login = array('nombre_usuario' => '', 'pass_usuario' => '');
                $CI->session->unset_userdata($unset_login);
                $CI->session->set_userdata($data);
                $CI->session->set_flashdata('actualiza','Los datos fueron actualizados correctamente');
                redirect(base_url()."index.php/plantilla_controller/?sec=configuracion_usuario",'refresh');
            }
        }else{
            redirect('plantilla_controller');
        }
    }   
}