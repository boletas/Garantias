<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banco_Model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function ObtieneBancos(){
        $query = $this->db->query("CALL pa_banco ('',2,0)");
        if ($query){
            $this->db->close();
            return $query->result();
        }else{
            return null;
        }
    }
    
    
}