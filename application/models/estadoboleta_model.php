<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EstadoBoleta_Model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function ObtieneEstadoBoletas(){
        $query = $this->db->query("CALL pa_estado_boleta('',2,0)");
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