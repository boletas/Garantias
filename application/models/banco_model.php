<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banco_Model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function ObtieneBancos(){
        
        $query = $this->db->query("CALL pa_banco ('',2,0)");
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
    
    public function EliminaBanco($idBanco){
        $query = $this->db->query("CALL pa_banco ('','4','".$idBanco."')");
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