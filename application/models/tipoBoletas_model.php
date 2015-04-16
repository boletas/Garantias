<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TipoBoletas_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function ObtieneTipoBoletas(){
        
        $query = $this->db->query("CALL pa_tipo_boleta('','',2,0)");
        if ($query){
            return $query->result();
        }else{
            return null;
        }
        
    }
    
    
}
