<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ultimo_Monto_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function ObtieneUltimoIngreso(){
        $query = $this->db->query("CALL pa_ultimo_monto()");
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