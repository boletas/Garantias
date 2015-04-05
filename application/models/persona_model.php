<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Persona_Model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function ObtienePersona($id){

        $query = $this->db->query("CALL select_user('$id')");
        
        if($query->num_rows() > 0){
            $this->db->close();
            return $query;
        }else{
            $this->db->close();
            return null;
        }
    }
}