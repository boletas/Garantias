<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anexo_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();
    }



    public function TraerBoleta($idBoleta){

    	$query = $this->db->query("CALL pa_boleta ('','','','','','','','','','','','2','".$idBoleta."','')");
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