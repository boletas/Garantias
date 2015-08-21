<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Retiro_model extends CI_Model{
    
     public function __construct(){
        parent::__construct();
     }
    
     public function BuscarRutNum($rut,$num){
         
        $query = $this->db->query("CALL retiro_xrut_xnum('".$rut."','".$num."')");
         
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
     
     public function  BuscarBoleta($id_boleta){
        $query = $this->db->query("CALL pa_boleta ('','','','','','','','','','','','2','".$id_boleta."','')");
        if ($query){
            $data = $query->row();
            $query->free_result();
            $this->db->close();
            return $data;
        }else{
            $query->free_result();
            $this->db->close();
            return null;
        }
    }
     
     public function BuscarXNum($num){
         $query = $this->db->query("CALL retiro_xnum('".$num."')");
         
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
     
     public function BuscarXRut($rut){
         $query = $this->db->query("CALL retiro_xrut('".$rut."')");
         
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
     
     public function EstadoBoleta($id_boleta,$id_estado_boleta){
         $query = $this->db->query("CALL pa_boleta ('','','','','','','','','','','".$id_estado_boleta."','5','".$id_boleta."','')");
         if($query){
            return true;  
         }else{
            return false; 
         }
     }
}