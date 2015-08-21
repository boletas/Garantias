<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entregadas_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function ListaEntregadas(){
        $query = $this->db->query("CALL pa_boleta ('','','','','','','','','','','2','6','','')");
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
    
    public function DetalleEntregada($idBoleta){
        $query = $this->db->query("CALL pa_boleta_entregada ('".$idBoleta."')");
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
}