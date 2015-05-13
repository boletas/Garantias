<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entidad_Model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function insert_entidad($rut_entidad,$nombre_entidad){
        
        $query = $this->db->query("CALL pa_entidad('".$rut_entidad."','".$nombre_entidad."',1,0)");
        
        if ($query){
            $this->session->set_userdata('idEntidad', $this->db->insert_id());
            $query->free_result();
            $this->db->close();
            return TRUE;
        }else{
            return FALSE;
        }
        
    }
    
    public function Entidades(){
        $query = $this->db->query("CALL pa_entidad('','',2,'0')");
        
        if ($query){
            $data = $query->result();
            
            $query->free_result();
            $this->db->close();
            return $data;
        }else{
            
            $query->free_result();
            $this->db->close();
            return FALSE;
        }
    }

        public function EntidadExiste($rut){
        
        $query = $this->db->query("CALL select_entidad('".$rut."')");
        
        if ($query){
            $data = $query->row();
            
            $query->free_result();
            $this->db->close();
            return $data;
        }else{
            $query->free_result();
            $this->db->close();
            return FALSE;
        }
        
    }
    
    public function TraerEntidad($id){
        $query = $this->db->query("CALL pa_entidad('','',2,'".$id."')");
        if ($query){
            $data = $query->result();
            $query->free_result();
            $this->db->close();
            return $data;
        }else{   
            $query->free_result();
            $this->db->close();
            return FALSE;
        }   
    }
}