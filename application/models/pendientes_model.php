<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendientes_Model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function ListaPendientes(){
        $query = $this->db->query("CALL pa_boleta ('','','','','','','','','','','3','6','','')");
        if ($query){
            $data = $query->result();
            $query->free_result();
            $this->db->close();
            return $data;
        }else{
            $query->free_result();
            $this->db->close();
            return null;
        }
    }
    
    public function GuardarRetiro($idBoleta,$rut,$nombre,$apellido){
        $query = $this->db->query("CALL pa_retiro(".$idBoleta.",".$rut.",'".$nombre."','".$apellido."');");
        if($query){
            $query->free_result();
            $this->db->close();
            return TRUE;
        }else{

            $query->free_result();
            $this->db->close();
            return FALSE;
        }    
    }
}