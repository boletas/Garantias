<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Moneda_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function ObtieneMoneda(){
        $query = $this->db->query("CALL pa_moneda('','' ,2,0)");
        if ($query){
            return $query->result();
        }else{
            return null;
        }
    }
    
    
}