<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entidad_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function insert_entidad($rut_entidad,$nombre_entidad){
        
        $query = $this->db->query("CALL pa_entidad('"+$rut_entidad+"','"+$nombre_entidad+"',1,0)");
        
        if ($query){
            $this->session->set_userdata('idEntidad', $this->db->insert_id());
            return TRUE;
        }else{
            return FALSE;
        }
        
    }
    
    public function EntidadExiste($rut){
        
        $query = $this->db->query("CALL select_entidad('".$rut."')");
        
        if ($query){
            
            $query->result();
            return TRUE;
        }else{
            return FALSE;
        }
        
    }
    
    public function TraerEntidad($id){
        
        $query = $this->db->query("CALL pa_entidad('','',2,'".$id."')");
        
        if ($query){
            return $query->result();
        }else{
            return FALSE;
        }
        
    }
    
    
    
}