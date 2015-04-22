<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entidad_controller extends MY_Mantenedor{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('entidad_model');
        
    }
    
    public function insert_entidad(){
        
        $rut_entidad = $this->input->post('rut_entidad');
        $rut = $rut_entidad;
        $nombre_entidad = $this->input->post('nombre_entidad');
        
        $rut_entidad = $this->entidad_model->EntidadExiste($rut);
        
        
        if($rut_entidad){
            $this->session->set_flashdata('insert','¡¡Esta entidad ya existe!!');
             
            redirect(base_url()."?sec=nueva_boleta",'refresh');
        }else{
            
            $insertok = $this->entidad_model->insert_entidad($rut,$nombre_entidad);
            
            if ($insertok) {
                $this->session->set_flashdata('insert','¡Entidad ingresada exitosamente!');
                redirect(base_url()."?sec=nueva_boleta",'refresh');
            }else{
                $this->session->set_flashdata('insert','Error al guardar entidad');
                redirect(base_url()."?sec=nueva_boleta",'refresh');
            }
        }
        
    }
    
    public function buscar_entidad(){
        $rut = $this->input->post('rut_buscar');
        
        $rut_entidad = $this->entidad_model->EntidadExiste($rut);
        
        if($rut_entidad){
            
            $this->session->set_userdata('idEntidad',$rut_entidad->idEntidad);
            $this->session->set_userdata('opcion', 'form1');
            redirect(base_url()."?sec=nueva_boleta",'refresh');
        }else{
            
            $this->session->set_flashdata('insert','No existe entidad con el rut ingresado.');
            $this->session->set_flashdata('op','si');
            redirect(base_url()."?sec=nueva_boleta",'refresh');
            
        }
        
        
        
        
        
    }
    
}