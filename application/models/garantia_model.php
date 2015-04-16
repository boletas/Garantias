<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Garantia_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function ObtieneGarantias(){
        
        $query = $this->db->query("CALL pa_tipo_garantia('','',2,0)");
        if ($query){
            return $query->result();
        }else{
            return null;
        }
        
    }
    
    
}

