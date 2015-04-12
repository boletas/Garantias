<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banco_Model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function ObtieneBancos(){
        $query = $this->db->query("CALL pa_banco ('',2,0)");
        if ($query){
            return $query->result();
        }else{
            return null;
        }
    }
    
    public function ExisteBanco($nuevo_banco){
        $query = $this->db->query("call pa_banco ('%".$nuevo_banco['nombre_banco']."%','5','0')");
        if($query){
            if ($query->num_rows() > 0){
                $this->db->close();
                return $query;
            }else{
                $this->db->close();
                $query->free_result();
                return null;
            }
        }
    }
    
    public function NuevoBanco($nuevo_banco){
        $query = $this->db->query("call pa_banco('".$nuevo_banco['nombre_banco']."','1','0')");
        if($query){
            $this->db->close();
            return $query;
        }else{
            return null;
        }
    }
}