<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Indicadores_Model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function GuardarIndicadores($uf,$dolar,$euro){
        $query = $this->db->query("CALL pa_indicadores('".$uf."','".$dolar."','".$euro."')");
        if ($query){
            $this->db->close();
            return true;
        }else{
            $this->db->close();
            return false;
        }
    }
    
    public function UltimoMonto(){
        $query = $this->db->query("CALL pa_ultimo_monto()");
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