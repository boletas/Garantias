<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Busqueda_Boleta_Model extends CI_Model{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function TodasBoletas(){
        $query = $this->db->query("CALL pa_busqueda_boleta ('1')");
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

?>